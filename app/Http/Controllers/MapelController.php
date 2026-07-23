<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $daftarMapel = Mapel::orderBy('nama_mapel', 'asc')->get();
        $totalMapel = Mapel::count();

        return view('mapel.index', [
            'daftarMapel' => $daftarMapel,
            'totalMapel' => $totalMapel,
        ]);
    }

    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'kode_mapel' => 'required|string|max:20|unique:mapels,kode_mapel',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        Mapel::create($validated);

        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran baru berhasil ditambahkan!');
    }

    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'kode_mapel' => 'required|string|max:20|unique:mapels,kode_mapel,'.$mapel->id,
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        $mapel->update($validated);

        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil diperbarui!');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil dihapus!');
    }
}
