<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    private function getCurrentGuru()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'guru') {
            return null;
        }
        $guruData = session('guru', []);
        $guru = collect($guruData)->firstWhere('id', $user['guru_id']);
        if ($guru) {
            return $guru;
        }
        // Fallback to user session data so teacher can still log in without pre-created guru record
        return [
            'id' => $user['guru_id'],
            'nama' => $user['name'],
            'mapel_ids' => []
        ];
    }
    
    private function getGuruMengajar($guruId)
    {
        $mengajarData = session('mengajar', []);
        $guruMengajar = collect($mengajarData)->where('guru_id', $guruId)->values();
        $mapelData = session('mata_pelajaran', []);
        $kelasData = session('kelas', []);
        
        return $guruMengajar->map(function($m) use ($mapelData, $kelasData) {
            $mapel = collect($mapelData)->firstWhere('id', $m['mapel_id']);
            $kelas = collect($kelasData)->firstWhere('id', $m['kelas_id']);
            
            return (object) [
                'id' => $m['id'],
                'mapel_id' => $m['mapel_id'],
                'mapel_nama' => $mapel['nama'] ?? '-',
                'kelas_id' => $m['kelas_id'],
                'kelas_nama' => $kelas['nama_kelas'] ?? '-',
                'semester' => $m['semester'],
            ];
        });
    }
    
    public function nama($id = null, $namaGuru = null)
    {
        $guru = $this->getCurrentGuru();
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Guru tidak ditemukan.');
        }
        $guruMengajar = $this->getGuruMengajar($guru['id']);
        return view('guru.dashboard_guru', [
            'id' => $guru['id'],
            'namaGuru' => $guru['nama'],
            'guruMengajar' => $guruMengajar,
        ]);
    }
    
    public function nilai(Request $request)
    {
        $guru = $this->getCurrentGuru();
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Guru tidak ditemukan.');
        }
        $guruMengajar = $this->getGuruMengajar($guru['id']);
        $kelasData = session('kelas', []);
        $siswaData = session('siswa', []);
        
        $filter = [
            'mengajarId' => $request->input('mengajar'),
            'kelasId' => $request->input('kelas'),
            'semester' => $request->input('semester', '1'),
            'mapelId' => $request->input('mapel'),
        ];
        
        if ($filter['mengajarId']) {
            $selectedMengajar = $guruMengajar->firstWhere('id', $filter['mengajarId']);
            if ($selectedMengajar) {
                $filter['mapelId'] = $selectedMengajar->mapel_id;
                $filter['kelasId'] = $selectedMengajar->kelas_id;
            }
        }
        
        $siswaList = collect($siswaData);
        if ($filter['kelasId']) {
            $siswaList = $siswaList->where('kelas_id', $filter['kelasId']);
        }
        
        $nilaiData = session('nilai', []);
        
        $siswaList = $siswaList->map(function($s) use ($nilaiData, $filter) {
            $nilai = collect($nilaiData)->firstWhere(function($n) use ($s, $filter) {
                return $n['siswa_id'] == $s['id'] && 
                       $n['mapel_id'] == $filter['mapelId'] && 
                       $n['semester'] == $filter['semester'];
            });
            
            return (object) [
                'id' => $s['id'],
                'nama' => $s['nama'],
                'nis' => $s['nis'],
                'harian' => $nilai['harian'] ?? null,
                'uts' => $nilai['uts'] ?? null,
                'uas' => $nilai['uas'] ?? null,
                'nilai_akhir' => $nilai['nilai_akhir'] ?? null,
                'status_kkm' => $nilai['status_kkm'] ?? null,
            ];
        });
        
        if ($request->isMethod('post')) {
            $inputNilai = $request->input('nilai', []);
            
            foreach ($siswaList as $siswa) {
                $sid = $siswa->id;
                $harian = $inputNilai['harian'][$sid] ?? null;
                $uts = $inputNilai['uts'][$sid] ?? null;
                $uas = $inputNilai['uas'][$sid] ?? null;
                
                if ($harian !== null || $uts !== null || $uas !== null) {
                    $nilai_akhir = null;
                    if ($harian !== null && $uts !== null && $uas !== null) {
                        $nilai_akhir = ($harian * 0.4) + ($uts * 0.3) + ($uas * 0.3);
                    }
                    
                    $mapelData2 = session('mata_pelajaran', []);
                    $mapel = collect($mapelData2)->firstWhere('id', $filter['mapelId']);
                    $kkm = $mapel['kkm'] ?? 75;
                    $status_kkm = $nilai_akhir !== null && $nilai_akhir >= $kkm ? 'lulus' : 'remedial';
                    
                    $existingIndex = null;
                    foreach ($nilaiData as $idx => $n) {
                        if ($n['siswa_id'] == $sid && $n['mapel_id'] == $filter['mapelId'] && $n['semester'] == $filter['semester']) {
                            $existingIndex = $idx;
                            break;
                        }
                    }
                    
                    $newNilai = [
                        'siswa_id' => $sid,
                        'mapel_id' => $filter['mapelId'],
                        'kelas_id' => $filter['kelasId'],
                        'semester' => $filter['semester'],
                        'harian' => $harian,
                        'uts' => $uts,
                        'uas' => $uas,
                        'nilai_akhir' => $nilai_akhir,
                        'kkm' => $kkm,
                        'status_kkm' => $status_kkm,
                    ];
                    
                    if ($existingIndex !== null) {
                        $nilaiData[$existingIndex] = $newNilai;
                    } else {
                        $nilaiData[] = $newNilai;
                    }
                }
            }
            
            session(['nilai' => $nilaiData]);
            return redirect()->route('guru.nilai')->with('success', 'Nilai berhasil disimpan.');
        }
        
        return view('guru.input-nilai', [
            'id' => $guru['id'],
            'namaGuru' => $guru['nama'],
            'siswaList' => $siswaList,
            'guruMengajar' => $guruMengajar,
            'kelasList' => collect($kelasData)->unique('id')->map(fn($k) => (object) $k),
            'filter' => $filter,
        ]);
    }
    
    public function hasilbelajar($id = null, $namaGuru = null)
    {
        return redirect()->route('guru.dashboard', ['id' => $id, 'namaGuru' => $namaGuru])
                        ->with('info', 'Halaman hasil belajar belum tersedia.');
    }
}
