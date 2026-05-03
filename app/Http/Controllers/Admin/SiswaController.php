<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswaData = session('siswa', []);
        $kelasData = session('kelas', []);
        
        $data = array_map(function($s) use ($kelasData) {
            $kelas = collect($kelasData)->firstWhere('id', $s['kelas_id'] ?? null);
            return (object) [
                'id' => $s['id'],
                'nis' => $s['nis'] ?? '-',
                'nama' => $s['nama'] ?? '-',
                'jenis_kelamin' => $s['jenis_kelamin'] ?? '-',
                'tahun_ajaran' => $s['tahun_ajaran'] ?? '-',
                'kelas' => (object) [
                    'id' => $s['kelas_id'] ?? null,
                    'nama_kelas' => $kelas['nama_kelas'] ?? '-',
                ],
                'wali_nama' => $kelas['wali_nama'] ?? '-',
            ];
        }, $siswaData);
        
        return view('admin.siswa.index', compact('data'));
    }

    public function create()
    {
        $kelasList = collect(session('kelas', []))->map(fn($k) => (object) $k);
        return view('admin.siswa.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $siswaData = session('siswa', []);
        
        // Generate ID
        $newId = collect($siswaData)->max('id') + 1 ?? 1;
        
        $newSiswa = [
            'id' => $newId,
            'nis' => $request->nis ?? 'NIS',
            'nama' => $request->nama ?? 'Siswa',
            'jenis_kelamin' => $request->jenis_kelamin ?? 'L',
            'tahun_ajaran' => $request->tahun_ajaran ?? '2025/2026',
            'kelas_id' => $request->kelas_id ?? null,
            'keterangan' => '',
            'kegiatan' => '',
            'ket_kegiatan' => '',
            'izin' => 0,
            'sakit' => 0,
            'alpha' => 0,
            'status_rapor' => 'belum'
        ];
        
        $siswaData[] = $newSiswa;
        session(['siswa' => $siswaData]);
        
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswaData = session('siswa', []);
        $siswa = collect($siswaData)->firstWhere('id', (int) $id);
        
        if (!$siswa) return redirect()->route('admin.siswa.index')->with('error', 'Data tidak ditemukan.');
        
        $siswa = (object) $siswa;
        $kelasList = collect(session('kelas', []))->map(fn($k) => (object) $k);
        return view('admin.siswa.edit', compact('siswa', 'kelasList'));
    }

    public function update(Request $request, $id)
    {
        $siswaData = session('siswa', []);
        
        foreach ($siswaData as &$s) {
            if ($s['id'] == $id) {
                $s['nis'] = $request->nis ?? $s['nis'];
                $s['nama'] = $request->nama ?? $s['nama'];
                $s['jenis_kelamin'] = $request->jenis_kelamin ?? $s['jenis_kelamin'];
                $s['tahun_ajaran'] = $request->tahun_ajaran ?? $s['tahun_ajaran'];
                $s['kelas_id'] = $request->kelas_id ?? $s['kelas_id'];
                break;
            }
        }
        
        session(['siswa' => $siswaData]);
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswaData = session('siswa', []);
        $siswaData = array_filter($siswaData, fn($s) => $s['id'] != $id);
        session(['siswa' => array_values($siswaData)]); // Re-index array
        
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
