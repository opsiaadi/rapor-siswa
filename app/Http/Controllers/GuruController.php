<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FakeDataHelper;

class GuruController extends Controller
{

    function nama($id = 'GR001', $namaGuru = 'Guru Mapel') {
        $kelasList = FakeDataHelper::getKelasOptions();
        $mapelList = FakeDataHelper::getMapelOptions();

        return view('pages.guru.dashboard', [
            'id' => $id,
            'namaGuru' => $namaGuru,
            'kelasList' => $kelasList,
            'mapelList' => $mapelList,
        ]);
    }

    public function nilai(Request $request) {
        $id = $request->input('guru_id', 'GR001');
        $namaGuru = $request->input('guru_nama', 'Guru Mapel');
        $kelasId = $request->input('kelas');

        // Ambil data dari FakeDataHelper (sama seperti admin)
        $allSiswa = FakeDataHelper::getSiswa();
        
        // Debug: cek apa yang diterima
        if (empty($allSiswa)) {
            // Force initialize dengan default
            $allSiswa = [
                ['id' => 1, 'nis' => '2024001', 'nama' => 'Ahmad Fauzi', 'jenis_kelamin' => 'L', 'tahun_ajaran' => '2024/2025', 'kelas_id' => 1, 'kelas_nama' => 'X-RPL 1'],
                ['id' => 2, 'nis' => '2024002', 'nama' => 'Siti Nurhaliza', 'jenis_kelamin' => 'P', 'tahun_ajaran' => '2024/2025', 'kelas_id' => 1, 'kelas_nama' => 'X-RPL 1'],
                ['id' => 3, 'nis' => '2024003', 'nama' => 'Budi Santoso', 'jenis_kelamin' => 'L', 'tahun_ajaran' => '2024/2025', 'kelas_id' => 2, 'kelas_nama' => 'X-RPL 2'],
            ];
        }
        
        // Filter siswa berdasarkan kelas_id
        $siswaList = [];
        foreach ($allSiswa as $siswa) {
            if (isset($siswa['kelas_id']) && $siswa['kelas_id'] == $kelasId) {
                $siswaList[] = $siswa;
            }
        }

        $kelasList = FakeDataHelper::getKelasOptions();
        $mapelList = FakeDataHelper::getMapelOptions();

        return view('pages.guru.dashboard', [
            'id' => $id,
            'namaGuru' => $namaGuru,
            'kelasList' => $kelasList,
            'mapelList' => $mapelList,
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
