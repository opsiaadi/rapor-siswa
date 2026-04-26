<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\FakeDataHelper;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function tampilkan(Request $request, $id = 'ADM001', $nama = 'Admin TU'){
        $stats = FakeDataHelper::getDashboardStats();
        $kelasData = FakeDataHelper::getKelasOptions();
        $allSiswa = FakeDataHelper::getSiswa();

        // Get unique tahun ajaran from siswa data
        $tahunAjaranList = collect($allSiswa)
            ->pluck('tahun_ajaran')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();
        if (empty($tahunAjaranList)) {
            $tahunAjaranList = ['2024/2025'];
        }

        // Selected tahun ajaran: from query param OR default to latest
        $selectedTA = $request->input('tahun_ajaran');
        if (!$selectedTA) {
            $selectedTA = end($tahunAjaranList);
        }

        // Filter siswa by tahun ajaran yang dipilih
        $filteredSiswa = array_filter($allSiswa, fn($s) => ($s['tahun_ajaran'] ?? '') === $selectedTA);

        // Hitung jumlah siswa per kelas berdasarkan filtered siswa
        $kelasPerKelas = [];
        foreach ($kelasData as $k) {
            $count = 0;
            foreach ($filteredSiswa as $s) {
                if (($s['kelas_id'] ?? 0) == ($k->id ?? 0)) $count++;
            }
            $kelasPerKelas[] = (object) [
                'nama_kelas' => $k->nama_kelas,
                'siswa_count' => $count,
            ];
        }

        $totalSiswa = array_sum(array_column($kelasPerKelas, 'siswa_count'));

        $recentSiswa = array_map(function($s) use ($kelasData) {
            $kelasObj = collect($kelasData)->firstWhere('id', $s['kelas_id'] ?? null);
            return (object) array_merge($s, [
                'wali_nama' => $kelasObj->wali_nama ?? '-',
            ]);
        }, FakeDataHelper::getRecentSiswa(5));

        return view('pages.admin.dashboard', [
            'id' => $id,
            'nama' => $nama,
            'stats' => $stats,
            'recentSiswa' => $recentSiswa,
            'tahunAjaranList' => $tahunAjaranList,
            'selectedTA' => $selectedTA,
            'kelasPerKelas' => $kelasPerKelas,
            'totalSiswa' => $totalSiswa,
        ]);
    }
}
