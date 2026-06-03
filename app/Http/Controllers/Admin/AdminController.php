<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function tampilkan(Request $request, $id = null, $nama = null)
    {
        $user = $this->getCurrentUser();
        $id = $user->id ?? $id;
        $nama = $user->nama ?? $nama;

        $stats = [
            'total_siswa' => Siswa::count(),
            'total_guru' => User::whereIn('role', ['guru', 'walikelas'])->count(),
            'total_mapel' => Mapel::count(),
            'total_kelas' => Kelas::count(),
        ];
        
        $tahunAjaranList = Siswa::distinct()->pluck('tahun_ajaran')->filter()->sort()->values();
        
        if ($tahunAjaranList->isEmpty()) {
            $tahunAjaranList = collect(['2024/2025']);
        }
        
        $selectedTA = $request->input('tahun_ajaran') ?? $tahunAjaranList->last();
        
        $kelasPerKelas = Kelas::withCount(['siswa' => function($query) use ($selectedTA) {
            $query->where('tahun_ajaran', $selectedTA);
        }])->get()->map(function($kelas) {
            return (object) [
                'nama_kelas' => $kelas->nama_kelas,
                'siswa_count' => $kelas->siswa_count,
            ];
        });
        
        $totalSiswa = $kelasPerKelas->sum('siswa_count');
        
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
