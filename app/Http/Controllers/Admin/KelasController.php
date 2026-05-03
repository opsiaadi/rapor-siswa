<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelasData = session('kelas', []);
        $guruData = session('guru', []);
        $siswaData = session('siswa', []);
        $mapelData = session('mata_pelajaran', []);
        
        $data = collect($kelasData)->map(function($k) use ($guruData, $siswaData, $mapelData) {
            $waliKelas = collect($guruData)->firstWhere('id', $k['wali_kelas_id'] ?? null);
            $siswaInKelas = array_filter($siswaData, fn($s) => ($s['kelas_id'] ?? null) == $k['id']);
            $mapels = array_filter($mapelData, fn($m) => in_array($m['id'] ?? null, $k['mapel_ids'] ?? []));
            
            return (object) [
                'id' => $k['id'],
                'nama_kelas' => $k['nama_kelas'] ?? '-',
                'tingkat' => $k['tingkat'] ?? '-',
                'wali_kelas' => $waliKelas ? (object) $waliKelas : null,
                'siswa' => collect(array_map(fn($s) => (object) $s, $siswaInKelas)),
                'siswa_count' => count($siswaInKelas),
                'mapel' => collect(array_map(fn($m) => (object) $m, $mapels)),
            ];
        });
        
        return view('admin.kelas.index', compact('data'));
    }

    public function create()
    {
        $guruList = collect(session('guru', []))->map(fn($g) => (object) $g);
        $mapelList = collect(session('mata_pelajaran', []))->map(fn($m) => (object) $m);
        $currentMapelGuru = [];
        return view('admin.kelas.create', compact('guruList', 'mapelList', 'currentMapelGuru'));
    }

    public function store(Request $request)
    {
        $kelasData = session('kelas', []);
        $newId = collect($kelasData)->max('id') + 1 ?? 1;
        
        $newKelas = [
            'id' => $newId,
            'nama_kelas' => $request->nama_kelas ?? 'Kelas',
            'wali_kelas_id' => $request->wali_kelas_id ?: null,
            'mapel_ids' => $request->mapel_ids ?? [],
            'tingkat' => $request->tingkat ?? null,
        ];
        
        $kelasData[] = $newKelas;
        session(['kelas' => $kelasData]);
        
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelasData = session('kelas', []);
        $kelas = collect($kelasData)->firstWhere('id', (int) $id);
        
        if (!$kelas) return redirect()->route('admin.kelas.index')->with('error', 'Data tidak ditemukan.');
        
        $kelas = (object) $kelas;
        $guruList = collect(session('guru', []))->map(fn($g) => (object) $g);
        $mapelList = collect(session('mata_pelajaran', []))->map(fn($m) => (object) $m);
        
        // Get current mapel_guru mapping
        $currentMapelGuru = [];
        foreach ($kelas->mapel_ids ?? [] as $mapelId) {
            // Find guru who teaches this mapel in this class
            $guruData = session('guru', []);
            foreach ($guruData as $g) {
                if (in_array($mapelId, $g['mapel_ids'] ?? [])) {
                    $currentMapelGuru[$mapelId] = $g['id'];
                    break;
                }
            }
        }
        
        $siswaList = collect(session('siswa', []))
            ->filter(fn($s) => ($s['kelas_id'] ?? null) == $id)
            ->map(fn($s) => (object) $s);
        
        return view('admin.kelas.edit', compact('kelas', 'guruList', 'mapelList', 'currentMapelGuru', 'siswaList'));
    }

    public function update(Request $request, $id)
    {
        $kelasData = session('kelas', []);
        
        foreach ($kelasData as &$k) {
            if ($k['id'] == $id) {
                $k['nama_kelas'] = $request->nama_kelas ?? $k['nama_kelas'];
                $k['wali_kelas_id'] = $request->wali_kelas_id ?: $k['wali_kelas_id'];
                $k['mapel_ids'] = $request->mapel_ids ?? $k['mapel_ids'];
                $k['tingkat'] = $request->tingkat ?? $k['tingkat'];
                break;
            }
        }
        
        session(['kelas' => $kelasData]);
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelasData = session('kelas', []);
        $kelasData = array_filter($kelasData, fn($k) => $k['id'] != $id);
        session(['kelas' => array_values($kelasData)]);
        
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
