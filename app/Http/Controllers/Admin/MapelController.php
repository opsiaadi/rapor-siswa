<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\FakeDataHelper;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $data = collect(array_map(fn($m) => (object) $m, FakeDataHelper::getMapel()));
        return view('admin.mapel.index', compact('data'));
    }

    public function create()
    {
        return view('admin.mapel.create');
    }

    public function store(Request $request)
    {
        $data = FakeDataHelper::getMapel();
        $data[] = [
            'id' => FakeDataHelper::nextId($data),
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kkm' => (int) $request->kkm,
        ];
        FakeDataHelper::saveMapel($data);
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = FakeDataHelper::findById(FakeDataHelper::getMapel(), $id);
        if (!$item) return redirect()->route('admin.mapel.index')->with('error', 'Data tidak ditemukan.');
        $mapel = (object) $item;
        return view('admin.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $data = FakeDataHelper::getMapel();
        FakeDataHelper::updateById($data, $id, [
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kkm' => (int) $request->kkm,
        ]);
        FakeDataHelper::saveMapel($data);
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = FakeDataHelper::removeById(FakeDataHelper::getMapel(), $id);
        FakeDataHelper::saveMapel($data);
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
