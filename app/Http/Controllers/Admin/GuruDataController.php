<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;

class GuruDataController extends Controller
{
    public function index()
    {
        $data = Guru::with('mapels')->get();
        return view('admin.guru.index', compact('data'));
    }

    public function create()
    {
        $mapelList = Mapel::all();
        return view('admin.guru.create', compact('mapelList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:guru,nik',
            'nama' => 'required',
            'email' => 'required|email|unique:guru,email',
            'password' => 'required',
        ]);

        $guru = Guru::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($request->has('mapel_ids')) {
            $guru->mapels()->sync($request->mapel_ids);
        }

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $guru = Guru::with('mapels')->findOrFail($id);
        $mapelList = Mapel::all();
        return view('admin.guru.edit', compact('guru', 'mapelList'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:guru,nik,' . $id,
            'nama' => 'required',
            'email' => 'required|email|unique:guru,email,' . $id,
        ]);

        $guru->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password ?: $guru->password,
        ]);

        if ($request->has('mapel_ids')) {
            $guru->mapels()->sync($request->mapel_ids);
        } else {
            $guru->mapels()->sync([]);
        }

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}