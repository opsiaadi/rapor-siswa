<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FakeDataHelper;

class GuruController extends Controller
{
    private function getBaseData()
    {
        return [
            'kelasList' => FakeDataHelper::getKelasOptions(),
            'mapelList' => FakeDataHelper::getMapelOptions(),
            'semesterList' => FakeDataHelper::getSemesterOptions(),
            'allSiswa' => FakeDataHelper::getSiswa(),
        ];
    }

    private function filterSiswa($allSiswa, $kelasId = null)
    {
        if ($kelasId) {
            return array_map(fn($s) => (object)$s, 
                array_filter($allSiswa, fn($s) => ($s['kelas_id'] ?? null) == $kelasId)
            );
        }
        return array_map(fn($s) => (object)$s, $allSiswa);
    }

    private function buildKelasSummary($kelasList, $allSiswa)
    {
        return array_map(fn($kelas) => [
            'id' => $kelas->id,
            'nama_kelas' => $kelas->nama_kelas,
            'siswa_count' => count(array_filter($allSiswa, fn($s) => ($s['kelas_id'] ?? null) == $kelas->id)),
            'tingkat' => $kelas->tingkat ?? '-',
        ], $kelasList);
    }

    private function getFilter(Request $request)
    {
        return [
            'kelasId' => $request->input('kelas'),
            'semester' => $request->input('semester'),
            'mapelId' => $request->input('mapel'),
        ];
    }

    private function getGuruMapel($guruId)
    {
        $guru = FakeDataHelper::findById(FakeDataHelper::getGuru(), $guruId);
        if (!$guru) return [];

        $mapelIds = $guru['mapel_ids'] ?? [];
        return array_values(array_filter(FakeDataHelper::getMapel(), fn($m) => in_array($m['id'], $mapelIds)));
    }

    public function nama($id = 'GR001', $namaGuru = 'Guru Mapel')
    {
        $base = $this->getBaseData();
        $guruMapel = $this->getGuruMapel($id);

        return view('guru.dashboard_guru', array_merge($base, [
            'title' => 'Dashboard Guru',
            'pageTitle' => 'Dashboard Guru',
            'breadcrumb' => 'Dashboard Guru',
            'id' => $id,
            'namaGuru' => $namaGuru,
            'guruMapel' => $guruMapel,
        ]));
    }

    public function hasilbelajar(Request $request, $id = 'GR001', $namaGuru = 'Guru Mapel')
    {
        $base = $this->getBaseData();
        $filter = $this->getFilter($request);

        $siswaList = $this->filterSiswa($base['allSiswa'], $filter['kelasId']);

        return view('guru.input-nilai', array_merge($base, [
            'title' => 'Hasil Belajar Siswa',
            'pageTitle' => 'Hasil Belajar Siswa',
            'breadcrumb' => 'Rekap nilai akhir siswa',
            'id' => $id,
            'namaGuru' => $namaGuru,
            'siswaList' => $siswaList,
            'jumlahSiswa' => count($siswaList),
            'kelasSummary' => $this->buildKelasSummary($base['kelasList'], $base['allSiswa']),
            'filter' => $filter,
        ]));
    }

    public function nilai(Request $request)
    {
        $id = $request->input('guru_id', 'GR001');
        $namaGuru = $request->input('guru_nama', 'Guru Mapel');
        $base = $this->getBaseData();
        $filter = $this->getFilter($request);

        $siswaList = $this->filterSiswa($base['allSiswa'], $filter['kelasId']);

        return view('guru.input-nilai', array_merge($base, [
            'title' => 'Input Nilai',
            'pageTitle' => 'Input Nilai Siswa',
            'breadcrumb' => 'Masukkan nilai harian, UTS, dan UAS',
            'id' => $id,
            'namaGuru' => $namaGuru,
            'siswaList' => $siswaList,
            'filter' => $filter,
        ]));
    }

    public function getGuru()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                ['id' => 'GR001', 'nama' => 'Budi Santoso', 'mapel' => 'Matematika'],
                ['id' => 'GR002', 'nama' => 'Ani Lestari', 'mapel' => 'Bahasa Indonesia']
            ]
        ]);
    }
}
