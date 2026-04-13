<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\FakeDataHelper;
use Illuminate\Http\Request;

class GuruDataController extends Controller
{
    public function index()
    {
        $data = collect(array_map(fn($g) => (object) $g, FakeDataHelper::getGuru()));
        return view('admin.guru.index', compact('data'));
    }

    public function create()
    {
        $mapelList = collect(FakeDataHelper::getMapelOptions());
        return view('admin.guru.create', compact('mapelList'));
    }

    public function store(Request $request)
    {
        $data = FakeDataHelper::getGuru();
        $data[] = [
            'id' => FakeDataHelper::nextId($data),
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'mapel_ids' => $request->mapel_ids ?? [],
        ];
        FakeDataHelper::saveGuru($data);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = FakeDataHelper::findById(FakeDataHelper::getGuru(), $id);
        if (!$item) return redirect()->route('admin.guru.index')->with('error', 'Data tidak ditemukan.');
        $guru = (object) $item;
        $mapelList = collect(FakeDataHelper::getMapelOptions());
        return view('admin.guru.edit', compact('guru', 'mapelList'));
    }

    public function update(Request $request, $id)
    {
        $data = FakeDataHelper::getGuru();
        FakeDataHelper::updateById($data, $id, [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'mapel_ids' => $request->mapel_ids ?? [],
        ]);
        FakeDataHelper::saveGuru($data);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = FakeDataHelper::removeById(FakeDataHelper::getGuru(), $id);
        FakeDataHelper::saveGuru($data);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
