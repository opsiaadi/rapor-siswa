<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class EskulController extends Controller
{
    public function index()
    {
        $data = Ekstrakurikuler::all();
        return view('admin.eskul.index', compact('data'));
    }

    public function create()
    {
        return view('admin.eskul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:ekstrakurikuler,nama',
        ], [
            'nama.unique' => 'Nama eskul sudah digunakan.',
        ]);

        Ekstrakurikuler::create([
            'nama' => $request->nama,
            'is_aktif' => $request->boolean('is_aktif', true),
        ]);

        return redirect()->route('admin.eskul.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $eskul = Ekstrakurikuler::findOrFail($id);
        return view('admin.eskul.edit', compact('eskul'));
    }

    public function update(Request $request, $id)
    {
        $eskul = Ekstrakurikuler::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:ekstrakurikuler,nama,' . $id,
        ], [
            'nama.unique' => 'Nama eskul sudah digunakan.',
        ]);

        $eskul->update([
            'nama' => $request->nama,
            'is_aktif' => $request->boolean('is_aktif', true),
        ]);

        return redirect()->route('admin.eskul.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $eskul = Ekstrakurikuler::findOrFail($id);
        $eskul->delete();

        return redirect()->route('admin.eskul.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
