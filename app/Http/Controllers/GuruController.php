<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FakeDataHelper;

class GuruController extends Controller
{

    function nama($id = 'GR001', $namaGuru = 'Guru Mapel') {
        $kelasList = FakeDataHelper::getKelasOptions();
        $mapelList = FakeDataHelper::getMapelOptions();
        $semesterList = FakeDataHelper::getSemesterOptions();

        return view('dashboard_guru', [
            'title' => 'Dashboard Guru',
            'pageTitle' => 'Dashboard Guru',
            'breadcrumb' => 'Input Nilai Siswa',
            'id' => $id,
            'namaGuru' => $namaGuru,
            'kelasList' => $kelasList,
            'mapelList' => $mapelList,
            'semesterList' => $semesterList,
        ]);
    }

    public function nilai(Request $request) {
        $id = $request->input('guru_id', 'GR001');
        $namaGuru = $request->input('guru_nama', 'Guru Mapel');
        $kelasId = $request->input('kelas');
        $semesterId = $request->input('semester');
        $mapelId = $request->input('mapel');

        // Debug
        \Illuminate\Support\Facades\Log::info('kelasId: ' . $kelasId . ', semesterId: ' . $semesterId . ', mapelId: ' . $mapelId);

        // Ambil data dari FakeDataHelper
        $allSiswa = FakeDataHelper::getSiswa();
        
        if (empty($allSiswa)) {
            $allSiswa = [
                ['id' => 1, 'nis' => '2024001', 'nama' => 'Ahmad Fauzi', 'jenis_kelamin' => 'L', 'tahun_ajaran' => '2024/2025', 'kelas_id' => 1, 'kelas_nama' => 'X-RPL 1'],
                ['id' => 2, 'nis' => '2024002', 'nama' => 'Siti Nurhaliza', 'jenis_kelamin' => 'P', 'tahun_ajaran' => '2024/2025', 'kelas_id' => 1, 'kelas_nama' => 'X-RPL 1'],
                ['id' => 3, 'nis' => '2024003', 'nama' => 'Budi Santoso', 'jenis_kelamin' => 'L', 'tahun_ajaran' => '2024/2025', 'kelas_id' => 2, 'kelas_nama' => 'X-RPL 2'],
            ];
        }
        
        // Filter siswa berdasarkan kelas_id (jika dipilih)
        $siswaList = [];
        if ($kelasId) {
            foreach ($allSiswa as $siswa) {
                $siswaObj = (object)$siswa;
                if (isset($siswaObj->kelas_id) && $siswaObj->kelas_id == $kelasId) {
                    $siswaList[] = $siswaObj;
                }
            }
        } else {
            // Jika belum pilih kelas, tampilkan semua siswa
            foreach ($allSiswa as $siswa) {
                $siswaList[] = (object)$siswa;
            }
        }

        $kelasList = FakeDataHelper::getKelasOptions();
        $mapelList = FakeDataHelper::getMapelOptions();
        $semesterList = FakeDataHelper::getSemesterOptions();

        return view('dashboard_guru', [
            'title' => 'Input Nilai',
            'pageTitle' => 'Input Nilai Siswa',
            'breadcrumb' => 'Masukkan nilai harian, UTS, dan UAS',
            'id' => $id,
            'namaGuru' => $namaGuru,
            'kelasList' => $kelasList,
            'mapelList' => $mapelList,
            'semesterList' => $semesterList,
            'siswaList' => $siswaList,
            'filter' => [
                'kelasId' => $kelasId,
                'semester' => $request->input('semester'),
                'mapelId' => $request->input('mapel'),
            ],
        ]);
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
