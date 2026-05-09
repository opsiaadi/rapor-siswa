<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function tampilkan(Request $request, $id = 'ADM001', $nama = 'Admin TU')
    {
        // Stats dari database
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_guru' => Guru::count(),
            'total_mapel' => Mapel::count(),
            'total_kelas' => Kelas::count(),
        ];
        
        // Get unique tahun ajaran from siswa
        $tahunAjaranList = Siswa::distinct()->pluck('tahun_ajaran')->filter()->sort()->values();
        
        if ($tahunAjaranList->isEmpty()) {
            $tahunAjaranList = collect(['2024/2025']);
        }
        
        // Selected tahun ajaran
        $selectedTA = $request->input('tahun_ajaran') ?? $tahunAjaranList->last();
        
        // Hitung jumlah siswa per kelas
        $kelasPerKelas = Kelas::withCount(['siswa' => function($query) use ($selectedTA) {
            $query->where('tahun_ajaran', $selectedTA);
        }])->get()->map(function($kelas) {
            return (object) [
                'nama_kelas' => $kelas->nama_kelas,
                'siswa_count' => $kelas->siswa_count,
            ];
        });
        
        $totalSiswa = $kelasPerKelas->sum('siswa_count');
        
        // Recent siswa (last 5)
        $recentSiswa = Siswa::with('kelas.waliKelas')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($s) {
                return (object) [
                    'id' => $s->id,
                    'nis' => $s->nis ?? '-',
                    'nama' => $s->nama ?? '-',
                    'jenis_kelamin' => $s->jenis_kelamin ?? '-',
                    'tahun_ajaran' => $s->tahun_ajaran ?? '-',
                    'kelas_id' => $s->kelas_id,
                    'kelas_nama' => $s->kelas->nama_kelas ?? '-',
                    'wali_nama' => $s->kelas->waliKelas->nama ?? '-',
                ];
            });
        
        return view('admin.dashboard_admin', [
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
