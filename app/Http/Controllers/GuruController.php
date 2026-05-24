<?php

namespace App\Http\Controllers;

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

        return view('guru.input-nilai', [
            'id' => $user->id,
            'namaGuru' => $user->nama,
            'siswaList' => $this->nilaiService->getSiswaNilaiForEdit($filter['kelasId'], $filter['mapelId'], $filter['semester']),
            'guruMengajar' => $guruMengajar,
            'kelasList' => $this->nilaiService->getKelasDropdownList($guruMengajar),
            'filter' => $filter,
        ]);
    }

    public function kirimNilai(Request $request)
    {
        $user = $this->getCurrentUser();
        $request->validate(array_merge(NilaiService::nilaiFieldRules(), [
            'mapel' => 'required|integer',
            'semester' => 'required|in:1,2',
            'mengajar' => 'required',
            'kelas' => 'required',
        ]));

        $this->nilaiService->saveNilaiBatch(
            $request->input('nilai', []),
            (int) $request->mapel,
            $request->semester,
            $user
        );

        return redirect()->route('guru.nilai', [
            'mengajar' => $request->mengajar,
            'kelas' => $request->kelas,
            'mapel' => $request->mapel,
            'semester' => $request->semester,
        ])->with('success', 'Nilai terkirim.');
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

    public function editNilai($kelasId, $mapelId, $semester = '1')
    {
        $user = $this->getCurrentUser();

        if (!in_array((int) $kelasId, $this->nilaiService->getGuruMengajar($user->id)->pluck('kelas_id')->toArray())) {
            return redirect()->route('guru.nilai')->with('error', 'Akses ditolak.');
        }

        return view('guru.edit-nilai', [
            'id' => $user->id,
            'namaGuru' => $user->nama,
            'siswaList' => $this->nilaiService->getSiswaNilaiForEdit((int) $kelasId, (int) $mapelId, $semester),
            'kelasId' => $kelasId,
            'mapelId' => $mapelId,
            'semester' => $semester,
        ]);
    }

    public function updateNilai(Request $request)
    {
        $user = $this->getCurrentUser();
        $request->validate(array_merge(NilaiService::nilaiFieldRules(), [
            'mapel_id' => 'required|integer',
            'semester' => 'required|in:1,2',
            'kelas_id' => 'required|integer',
        ]));

        $this->nilaiService->saveNilaiBatch(
            $request->input('nilai', []),
            (int) $request->mapel_id,
            $request->semester,
            $user
        );

        return redirect()->route('guru.nilai', [
            'mengajar' => $this->nilaiService->findMengajarId((int) $request->kelas_id, (int) $request->mapel_id, $user->id),
            'kelas' => $request->kelas_id,
            'mapel' => $request->mapel_id,
            'semester' => $request->semester,
        ])->with('success', 'Nilai berhasil diperbarui.');
    }
}
