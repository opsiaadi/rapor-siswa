<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $data = collect(session('mata_pelajaran', []))->map(fn($m) => (object) $m);
        return view('admin.mapel.index', compact('data'));
    }

    public function create()
    {
        return view('admin.mapel.create');
    }

    public function store(Request $request)
    {
        $mapelData = session('mata_pelajaran', []);
        $newId = collect($mapelData)->max('id') + 1 ?? 1;
        
        $newMapel = [
            'id' => $newId,
            'nama' => $request->nama ?? 'Mata Pelajaran',
            'kode_mapel' => $request->kode_mapel ?? '',
            'kkm' => $request->kkm ?? 75,
            'kategori' => $request->kategori ?? 'wajib',
        ];
        
        $mapelData[] = $newMapel;
        session(['mata_pelajaran' => $mapelData]);
        
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapelData = session('mata_pelajaran', []);
        $mapel = collect($mapelData)->firstWhere('id', (int) $id);
        
        if (!$mapel) return redirect()->route('admin.mapel.index')->with('error', 'Data tidak ditemukan.');
        
        $mapel = (object) $mapel;
        return view('admin.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $mapelData = session('mata_pelajaran', []);
        
        foreach ($mapelData as &$m) {
            if ($m['id'] == $id) {
                $m['nama'] = $request->nama ?? $m['nama'];
                $m['kode_mapel'] = $request->kode_mapel ?? $m['kode_mapel'];
                $m['kkm'] = $request->kkm ?? $m['kkm'];
                $m['kategori'] = $request->kategori ?? $m['kategori'];
                break;
            }
        }
        
        session(['mata_pelajaran' => $mapelData]);
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapelData = session('mata_pelajaran', []);
        $mapelData = array_filter($mapelData, fn($m) => $m['id'] != $id);
        session(['mata_pelajaran' => array_values($mapelData)]);
        
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
