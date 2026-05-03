<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    private function getCurrentGuru(): ?array
    {
        $user = session('user');
        if (!$user || !isset($user['guru_id'])) return null;
        
        $guruData = session('guru', []);
        return collect($guruData)->firstWhere('id', $user['guru_id']);
    }
    
    private function guru(): array
    {
        $guru = $this->getCurrentGuru();
        return [
            'id' => $guru['id'] ?? 1,
            'nama' => $guru['nama'] ?? 'Wali Kelas',
        ];
    }
    
    private function kelas(): array
    {
        $g = $this->guru();
        $allKelas = session('kelas', []);
        
        $filtered = array_filter($allKelas, fn($k) => 
            ($k['wali_kelas_id'] ?? null) == $g['id']
        );
        
        $filtered = array_values($filtered);
        if (!empty($filtered)) return $filtered;
        
        return array_slice($allKelas, 0, 1);
    }
    
    private function siswaData(array $kelas): array
    {
        $ids = array_column($kelas, 'id');
        $allSiswa = session('siswa', []);
        
        return array_map(function($s) {
            return (object) [
                'id' => $s['id'],
                'nis' => $s['nis'],
                'nama' => $s['nama'],
                'jenis_kelamin' => $s['jenis_kelamin'],
                'tahun_ajaran' => $s['tahun_ajaran'] ?? '-',
                'kelas_id' => $s['kelas_id'],
                'kelas' => (object) (collect(session('kelas', []))->firstWhere('id', $s['kelas_id']) ?? (object) ['nama_kelas' => '-']),
                'keterangan' => $s['keterangan'] ?? '',
                'kegiatan' => $s['kegiatan'] ?? '',
                'ket_kegiatan' => $s['ket_kegiatan'] ?? '',
                'izin' => $s['izin'] ?? 0,
                'sakit' => $s['sakit'] ?? 0,
                'alpha' => $s['alpha'] ?? 0,
                'status_rapor' => $s['status_rapor'] ?? 'belum',
            ];
        }, array_filter($allSiswa, fn($s) => in_array($s['kelas_id'] ?? null, $ids)));
    }
    
    private function getSiswa($id): ?object
    {
        $siswaData = session('siswa', []);
        $siswaArray = collect($siswaData)->firstWhere('id', (int) $id);
        if (!$siswaArray) return null;
        
        return (object) [
            'id' => $siswaArray['id'],
            'nis' => $siswaArray['nis'],
            'nama' => $siswaArray['nama'],
            'jenis_kelamin' => $siswaArray['jenis_kelamin'],
            'tahun_ajaran' => $siswaArray['tahun_ajaran'] ?? '-',
            'kelas_id' => $siswaArray['kelas_id'],
            'kelas' => (object) (collect(session('kelas', []))->firstWhere('id', $siswaArray['kelas_id']) ?? ['nama_kelas' => '-']),
            'keterangan' => $siswaArray['keterangan'] ?? '',
            'kegiatan' => $siswaArray['kegiatan'] ?? '',
            'ket_kegiatan' => $siswaArray['ket_kegiatan'] ?? '',
            'izin' => $siswaArray['izin'] ?? 0,
            'sakit' => $siswaArray['sakit'] ?? 0,
            'alpha' => $siswaArray['alpha'] ?? 0,
            'status_rapor' => $siswaArray['status_rapor'] ?? 'belum',
        ];
    }
    
    private function updateSiswa($id, $data, $route)
    {
        $siswaData = session('siswa', []);
        $found = false;
        
        foreach ($siswaData as &$s) {
            if ($s['id'] == $id) {
                $s = array_merge($s, $data);
                $s['status_rapor'] = 'sudah';
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            return redirect()->route($route)->with('error', 'Siswa tidak ditemukan.');
        }
        
        session(['siswa' => $siswaData]);
        
        $msg = $route == 'walikelas.siswa' ? 'Keterangan' : 'Finalisasi rapor';
        return redirect()->route($route)->with('success', $msg.' berhasil disimpan.');
    }
    
    public function dashboard()
    {
        $g = $this->guru(); 
        $k = $this->kelas(); 
        $s = $this->siswaData($k); 
        $e = $k[0] ?? null;
        
        $guru = $this->getCurrentGuru();
        $mapel_ids = $guru['mapel_ids'] ?? [];
        
        return view('walikelas.dashboard', [
            'id' => $g['id'], 'namaGuru' => $g['nama'],
            'kelasList' => collect(array_map(fn($k) => (object) $k, session('kelas', []))),
            'assignedClasses' => collect($k), 'selectedClass' => (object) ($e ?? []), 'siswaList' => collect($s),
            'stats' => [
                'kelas_perwalian' => count($k), 
                'total_siswa' => count($s),
                'mapel_diampu' => count($mapel_ids),
                'kelas_utama' => $e['nama_kelas'] ?? '-'
            ]
        ]);
    }
    
    public function finalisasi()
    {
        $g = $this->guru(); 
        $k = $this->kelas();
        $siswaList = $this->siswaData($k);
        
        return view('walikelas.form_finalisasi', [
            'id' => $g['id'], 'namaGuru' => $g['nama'],
            'assignedClasses' => collect($k), 'kelasUtama' => (object) ($k[0] ?? []),
            'siswaList' => $siswaList
        ]);
    }
    
    public function siswa()
    {
        $g = $this->guru(); 
        $k = $this->kelas(); 
        
        return view('walikelas.data_siswa', [
            'id' => $g['id'], 'namaGuru' => $g['nama'],
            'siswaList' => collect($this->siswaData($k)), 'assignedClasses' => collect($k),
            'kelasUtama' => (object) ($k[0] ?? [])
        ]);
    }
    
    public function rapor($siswaId)
    {
        $sw = $this->getSiswa($siswaId);
        if (!$sw) return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');
        
        $g = $this->guru(); 
        $k = $this->kelas(); 
        
        // Get nilai for this siswa
        $nilaiData = session('nilai', []);
        $siswaNilai = collect($nilaiData)->where('siswa_id', $siswaId);
        
        $nilaiPerMapel = $siswaNilai->map(function($n) {
            $mapelData = session('mata_pelajaran', []);
            $mapel = collect($mapelData)->firstWhere('id', $n['mapel_id']);
            return (object) [
                'mapel_nama' => $mapel['nama'] ?? '-',
                'harian' => $n['harian'],
                'uts' => $n['uts'],
                'uas' => $n['uas'],
                'nilai_akhir' => $n['nilai_akhir'],
                'kkm' => $n['kkm'],
                'status_kkm' => $n['status_kkm'],
            ];
        });
        
        return view('walikelas.rapor_siswa', [
            'id' => $g['id'], 'namaGuru' => $g['nama'],
            'siswa' => $sw, 'kelasUtama' => (object) ($k[0] ?? []), 'assignedClasses' => collect($k),
            'nilaiList' => $nilaiPerMapel,
        ]);
    }
    
    public function simpanKeterangan(Request $request, $siswaId)
    {
        return $this->updateSiswa($siswaId, [
            'keterangan' => $request->keterangan ?? '',
            'kegiatan' => $request->kegiatan ?? '',
            'ket_kegiatan' => $request->ket_kegiatan ?? '',
            'izin' => $request->izin ?? 0,
            'sakit' => $request->sakit ?? 0,
            'alpha' => $request->alpha ?? 0,
        ], 'walikelas.finalisasi');
    }
}
