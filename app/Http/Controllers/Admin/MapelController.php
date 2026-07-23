<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Notifications\MapelNotification;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $data = Mapel::all();

        return view('admin.mapel.index', compact('data'));
    }

    public function create()
    {
        return view('admin.mapel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => 'required|unique:mapel,kode_mapel',
            'nama_mapel' => 'required',
            'kkm' => 'required|integer|min:0|max:100',
        ], [
            'kode_mapel.unique' => 'Kode mapel sudah digunakan.',
            'kkm.min' => 'KKM minimal 0.',
            'kkm.max' => 'KKM maksimal 100.',
        ]);

        Mapel::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kkm' => $request->kkm,
        ]);

        $user = $this->getCurrentUser();
        $user->notify(new MapelNotification('tambah', $request->nama_mapel, route('admin.mapel.index')));

        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);

        return view('admin.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        $request->validate([
            'kode_mapel' => 'required|unique:mapel,kode_mapel,'.$id,
            'nama_mapel' => 'required',
            'kkm' => 'required|integer|min:0|max:100',
        ], [
            'kode_mapel.unique' => 'Kode mapel sudah digunakan.',
            'kkm.min' => 'KKM minimal 0.',
            'kkm.max' => 'KKM maksimal 100.',
        ]);

        $mapel->update([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kkm' => $request->kkm,
        ]);

        $user = $this->getCurrentUser();
        $user->notify(new MapelNotification('ubah', $mapel->nama_mapel, route('admin.mapel.index')));

        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        $user = $this->getCurrentUser();
        $user->notify(new MapelNotification('hapus', $mapel->nama_mapel, route('admin.mapel.index')));

        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
