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

        return redirect()->route('guru.nilai', [
            'mengajar' => $mengajar,
            'kelas' => $kelasId,
            'mapel' => $mapelId,
            'semester' => $request->semester,
        ])->with('success', 'Nilai berhasil disimpan.');
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
