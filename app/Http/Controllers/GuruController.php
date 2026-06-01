<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Notification;
use App\Models\User;
use App\Services\NilaiMapperService;
use App\Services\NilaiService;
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
                return redirect()->route('guru.nilai')->with('error', 'Akses ditolak.');
            }
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
        ]);
    }

    public function editNilai($kelasId, $mapelId, $semester = '1')
    {
        return redirect()->route('guru.nilai', [
            'kelas_id' => $kelasId,
            'mapel_id' => $mapelId,
            'semester' => $semester,
        ]);
    }

    public function kirimNilai(Request $request)
    {
        $user = $this->getCurrentUser();
        $mapelId = (int) ($request->mapel_id ?? $request->mapel);
        $kelasId = (int) ($request->kelas_id ?? $request->kelas);

        $request->validate(array_merge(NilaiService::nilaiFieldRules(), [
            'semester' => 'required|in:1,2',
            'mapel' => 'required_without:mapel_id|integer',
            'mapel_id' => 'required_without:mapel|integer',
            'kelas' => 'required_without:kelas_id|integer',
            'kelas_id' => 'required_without:kelas|integer',
        ]));

        $this->nilaiService->saveNilaiBatch(
            $request->input('nilai', []),
            $mapelId,
            $request->semester,
            $user
        );

        $mengajar = $this->nilaiService->findMengajarId($kelasId, $mapelId, $user->id);

        $kelasNama = Kelas::find($kelasId)?->nama_kelas ?? "ID {$kelasId}";
        $mapelNama = Mapel::find($mapelId)?->nama_mapel ?? "ID {$mapelId}";

        $action = $request->input('action', 'kirim');
        $notifTitle = $action === 'update' ? 'Nilai Diperbarui' : 'Nilai Terkirim';
        $notifMsg = $action === 'update'
            ? "Nilai {$mapelNama} untuk kelas {$kelasNama} berhasil diperbarui."
            : "Nilai {$mapelNama} untuk kelas {$kelasNama} berhasil dikirim.";
        $flashMsg = $action === 'update' ? 'Nilai berhasil diperbarui.' : 'Nilai berhasil dikirim.';

        Notification::create([
            'user_id' => $user->id,
            'title' => $notifTitle,
            'message' => $notifMsg,
            'type' => 'success',
            'url' => route('guru.nilai', ['mengajar' => $mengajar, 'kelas' => $kelasId, 'mapel' => $mapelId, 'semester' => $request->semester]),
        ]);

        $admins = User::whereIn('role', ['admin', 'super_admin'])->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => $notifTitle,
                'message' => "{$user->nama} mengirim nilai {$mapelNama} untuk kelas {$kelasNama} Semester {$request->semester}",
                'type' => 'success',
                'url' => route('admin.guru.index'),
            ]);
        }

        return redirect()->route('guru.nilai', [
            'mengajar' => $mengajar,
            'kelas' => $kelasId,
            'mapel' => $mapelId,
            'semester' => $request->semester,
        ])->with('success', $flashMsg);
    }

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
}
