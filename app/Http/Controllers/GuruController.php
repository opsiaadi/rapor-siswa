<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
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
    ){}

    public function nama($id = null, $namaGuru = null)
    {
        $user = $this->getCurrentUser();
        return view('guru.dashboard_guru', [
            'id' => $user->id,
            'namaGuru' => $user->nama,
            'guruMengajar' => $this->nilaiService->getGuruMengajar($user->id),
        ]);
    }

    public function tampilNilai($kelasId, $mapelId, $semester = '1')
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

        $kelasId = $request->input('kelas_id', $filter['kelasId']);
        $mapelId = $request->input('mapel_id', $filter['mapelId']);
        $semester = $request->input('semester', $filter['semester']);
        $editMode = $request->has('kelas_id');

        if ($kelasId && $mapelId && $editMode) {
            if (!in_array((int) $kelasId, $guruMengajar->pluck('kelas_id')->toArray())) {
                return redirect()->route('guru.nilai')->with('error', 'data nilai belum dimasukkan');
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
            'kelasId' => $kelasId,
            'mapelId' => $mapelId,
            'semester' => $semester,
            'isLocked' => $isLocked,
        ]);
    }

    public function kirimNilai(Request $request)
    {
        $user = $this->getCurrentUser();
        $mapelId = (int) $request->mapel_id;
        $kelasId = (int) $request->kelas_id;

        $request->validate(array_merge(NilaiService::nilaiFieldRules(), [
            'semester' => 'required|in:1,2',
            'mapel_id' => 'required|integer',
            'kelas_id' => 'required|integer',
        ]));

        $this->nilaiService->saveNilaiBatch(
            $request->input('nilai', []),
            $mapelId,
            $request->semester,
            $user
        );

        return $this->notifyNilai($request->input('action', 'kirim'), $user, $kelasId, $mapelId, $request->semester);
    }

    // menampilkan seluruh siswa yang memiliki rapor
    public function daftarRapor()
    {
        $user = $this->getCurrentUser();
        return view('guru.daftar_rapor', [
            'id' => $user->id,
            'namaGuru' => $user->nama,
            'siswaList' => $this->nilaiService->getRaporSiswaList($user->id),
        ]);
    }

    public function lihatRapor($siswaId)
    {
        $user = $this->getCurrentUser();
        $data = $this->nilaiService->getRaporData($siswaId, $user->id, request('semester', '1'));
        if (!$data) return redirect()->route('guru.rapor')->with('error', 'Siswa tidak ditemukan.');
        $data['id'] = $user->id;
        $data['namaGuru'] = $user->nama;
        return view('guru.rapor_lihat', $data);
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
