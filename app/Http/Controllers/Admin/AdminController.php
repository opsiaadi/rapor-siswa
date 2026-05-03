<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function tampilkan(Request $request, $id = 'ADM001', $nama = 'Admin TU')
    {
        // Stats dari session
        $siswaData = session('siswa', []);
        $guruData = session('guru', []);
        $mapelData = session('mata_pelajaran', []);
        $kelasData = session('kelas', []);
        
        $stats = [
            'total_siswa' => count($siswaData),
            'total_guru' => count($guruData),
            'total_mapel' => count($mapelData),
            'total_kelas' => count($kelasData),
        ];
        
        // Get unique tahun ajaran from siswa
        $tahunAjaranList = array_unique(array_column($siswaData, 'tahun_ajaran'));
        sort($tahunAjaranList);
        $tahunAjaranList = array_values(array_filter($tahunAjaranList));
        
        if (empty($tahunAjaranList)) {
            $tahunAjaranList = ['2024/2025'];
        }
        
        // Selected tahun ajaran
        $selectedTA = $request->input('tahun_ajaran');
        if (!$selectedTA) {
            $selectedTA = end($tahunAjaranList);
        }
        
        // Filter siswa by tahun ajaran
        $filteredSiswa = array_filter($siswaData, fn($s) => ($s['tahun_ajaran'] ?? '') === $selectedTA);
        
        // Hitung jumlah siswa per kelas
        $kelasPerKelas = [];
        foreach ($kelasData as $k) {
            $count = count(array_filter($filteredSiswa, fn($s) => ($s['kelas_id'] ?? null) == $k['id']));
            $kelasPerKelas[] = (object) [
                'nama_kelas' => $k['nama_kelas'] ?? '-',
                'siswa_count' => $count,
            ];
        }
        
        $totalSiswa = array_sum(array_column($kelasPerKelas, 'siswa_count'));
        
        // Recent siswa (last 5)
        $recentSiswaData = array_slice($siswaData, -5);
        $recentSiswa = array_map(function($s) use ($kelasData, $guruData) {
            $kelas = collect($kelasData)->firstWhere('id', $s['kelas_id'] ?? null);
            $waliKelas = $kelas ? collect($guruData)->firstWhere('id', $kelas['wali_kelas_id'] ?? null) : null;
            
            return (object) [
                'id' => $s['id'],
                'nis' => $s['nis'] ?? '-',
                'nama' => $s['nama'] ?? '-',
                'jenis_kelamin' => $s['jenis_kelamin'] ?? '-',
                'tahun_ajaran' => $s['tahun_ajaran'] ?? '-',
                'kelas_id' => $s['kelas_id'] ?? null,
                'kelas_nama' => $kelas['nama_kelas'] ?? '-',
                'wali_nama' => $waliKelas['nama'] ?? '-',
            ];
        }, $recentSiswaData);
        
        return view('admin.dashboard_admin', [
            'id' => $id,
            'nama' => $nama,
            'stats' => $stats,
            'recentSiswa' => collect($recentSiswa),
            'tahunAjaranList' => $tahunAjaranList,
            'selectedTA' => $selectedTA,
            'kelasPerKelas' => $kelasPerKelas,
            'totalSiswa' => $totalSiswa,
        ]);
    }
}
