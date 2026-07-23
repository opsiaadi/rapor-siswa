<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Notifications\NilaiDiperbarui;
use App\Notifications\NilaiTerkirim;
use App\Services\NilaiMapperService;
use App\Services\NilaiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function __construct(
        private NilaiMapperService $nilaiMapperService,
        private NilaiService $nilaiService,
    ) {}

    public function nama($id = null, $namaGuru = null)
    {
        $user = $this->getCurrentUser();

        return view('guru.dashboard_guru', [
            'id' => $user->id,
            'namaGuru' => $user->nama,
            'guruMengajar' => $this->nilaiService->getGuruMengajar($user->id),
        ]);
    }

    public function tampilNilai($kelasId, $mapelId, $semester)
    {
        return redirect()->route('guru.nilai', [
            'kelas_id' => $kelasId,
            'mapel_id' => $mapelId,
            'semester' => $semester,
        ]);
    }

    public function nilai(Request $request)
    {
        $user = $this->getCurrentUser();
        $guruMengajar = $this->nilaiService->getGuruMengajar($user->id);
        $filter = $this->nilaiService->resolveFilter($request, $guruMengajar);

        $mapelId = $request->input('mapel_id', $filter['mapelId']);
        $kelasId = $request->input('kelas_id', $filter['kelasId']);
        $semester = $request->input('semester', $filter['semester']);
        $editMode = $request->has('kelas_id');

        if ($kelasId && $mapelId && $editMode) {
            if (! in_array((int) $kelasId, $guruMengajar->pluck('kelas_id')->toArray())) {
                return redirect()->route('guru.nilai');
            }
        }

        $isLocked = false;

        if ($kelasId && $mapelId) {
            $isLocked = Nilai::where('mapel_id', $mapelId)
                ->where('semester', $semester)
                ->where('status', 'dikirim')
                ->exists();
        }

        return view($editMode ? 'guru.edit-nilai' : 'guru.input-nilai', [
            'id' => $user->id,
            'namaGuru' => $user->nama,
            'siswaList' => $kelasId && $mapelId
                ? $this->nilaiService->getSiswaNilaiForEdit((int) $kelasId, (int) $mapelId, $semester)
                : collect(),
            'guruMengajar' => $guruMengajar,
            'kelasList' => $this->nilaiService->getKelasDropdownList($guruMengajar),
            'filter' => $filter,
            'kelas' => $kelasId,
            'mapelId' => $mapelId,
            'kelasId' => $kelasId,
            'semester' => $semester,
        ]);
    }

    public function kirimNilai(Request $request)
    {
        $user = $this->getCurrentUser();
        $mapelId = (int) $request->mapel_id;
        $kelasId = (int) $request->kelas_id;

        $nilaiData = $request->input('nilai', []);
        $rules = array_merge(NilaiService::nilaiFieldRules(), [
            'semester' => 'required|in:1,2',
            'mapel_id' => 'required|integer',
            'kelas_id' => 'required|integer',

        ]);
        $allEmpty = true;
        foreach ($nilaiData['harian'] ?? [] as $siswaId => $value) {
            if (! empty($value) || ! empty($nilaiData['uts'][$siswaId]) || ! empty($nilaiData['uas'][$siswaId])) {
                $allEmpty = false;
                break;
            }
        }
        if ($allEmpty) {
            return back()->withErrors(['nilai' => 'Nilai tidak boleh kosong.'])->withInput();
        }
        $this->nilaiService->saveNilaiBatch($nilaiData, $mapelId, $request->semester, $user);

        return $this->notifyNilai($request->input('action', 'kirim'), $user, $kelasId, $mapelId, $request->semester);
    }

    // menampilkan daftar nilai/nama siswa
    public function daftarNilai()
    {
        $user = $this->getCurrentUser();

        return view('guru.daftar_nilai', [
            'id' => $user->id,
            'namaGuru' => $user->nama,
            'siswaList' => $this->nilaiService->getRaporSiswaList($user->id),
        ]);
    }

    // lihat nilai siswa
    public function lihatNilai($siswaId)
    {
        $user = $this->getCurrentUser();
        $data = $this->nilaiService->getRaporData($siswaId, $user->id, request('semester', '2'));
        if (! $data) {
            return redirect()->route('guru.nilai.daftar');
        }
        $data['id'] = $user->id;
        $data['namaGuru'] = $user->nama;

        return view('guru.lihat_nilai', $data);
    }

    // notifikasi tambah nilai/nilai diperbarui ke guru
    private function notifyNilai(string $action, $user, int $kelasId, int $mapelId, string $semester): RedirectResponse
    {
        $mengajar = $this->nilaiService->findMengajarId($kelasId, $mapelId, $user->id);
        $kelasNama = Kelas::find($kelasId)?->nama_kelas ?? "ID {$kelasId}";
        $mapelNama = Mapel::find($mapelId)?->nama_mapel ?? "ID {$mapelId}";
        $isUpdate = $action === 'update';
        $redirectUrl = route('guru.nilai', [
            'mengajar' => $mengajar,
            'kelas' => $kelasId,
            'mapel' => $mapelId,
            'semester' => $semester,
        ]);
        // notifikasi ke admin berupa nilai yang terkirim dan nilai yang diperbarui guru
        $notificationClass = $isUpdate ? NilaiDiperbarui::class : NilaiTerkirim::class;

        $user->notify(new $notificationClass($mapelNama, $kelasNama, $semester, $redirectUrl));

        NotificationController::notifyAdmins(new $notificationClass($mapelNama, $kelasNama, $semester, route('admin.guru.index')));

        return redirect($redirectUrl)->with('success', $isUpdate ? 'Nilai berhasil diperbarui.' : 'Nilai berhasil dikirim.');
    }
}
