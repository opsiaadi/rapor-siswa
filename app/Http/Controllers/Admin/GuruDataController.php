<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruDataController extends Controller
{
    public function index()
    {
        $guruData = session('guru', []);
        $mapelData = session('mata_pelajaran', []);
        
        $data = array_map(function($g) use ($mapelData) {
            $mapels = array_filter($mapelData, fn($m) => in_array($m['id'], $g['mapel_ids'] ?? []));
            return (object) [
                'id' => $g['id'],
                'nama' => $g['nama'] ?? '-',
                'email' => $g['email'] ?? '-',
                'mapel_ids' => $g['mapel_ids'] ?? [],
                'mapels' => collect(array_map(fn($m) => (object) $m, $mapels)),
            ];
        }, $guruData);
        
        return view('admin.guru.index', compact('data'));
    }

    public function create()
    {
        $mapelList = collect(session('mata_pelajaran', []))->map(fn($m) => (object) $m);
        return view('admin.guru.create', compact('mapelList'));
    }

    public function store(Request $request)
    {
        $guruData = session('guru', []);
        $newId = collect($guruData)->max('id') + 1 ?? 1;
        
        $newGuru = [
            'id' => $newId,
            'nama' => $request->nama ?? 'Guru',
            'email' => $request->email ?? '',
            'mapel_ids' => $request->mapel_ids ?? [],
        ];
        
        $guruData[] = $newGuru;
        session(['guru' => $guruData]);
        
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $guruData = session('guru', []);
        $guru = collect($guruData)->firstWhere('id', (int) $id);
        
        if (!$guru) return redirect()->route('admin.guru.index')->with('error', 'Data tidak ditemukan.');
        
        $guru = (object) $guru;
        $mapelList = collect(session('mata_pelajaran', []))->map(fn($m) => (object) $m);
        return view('admin.guru.edit', compact('guru', 'mapelList'));
    }

    public function update(Request $request, $id)
    {
        $guruData = session('guru', []);
        
        foreach ($guruData as &$g) {
            if ($g['id'] == $id) {
                $g['nama'] = $request->nama ?? $g['nama'];
                $g['email'] = $request->email ?? $g['email'];
                $g['mapel_ids'] = $request->mapel_ids ?? $g['mapel_ids'];
                break;
            }
        }
        
        session(['guru' => $guruData]);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $guruData = session('guru', []);
        $guruData = array_filter($guruData, fn($g) => $g['id'] != $id);
        session(['guru' => array_values($guruData)]);
        
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
