<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Siswa::with(['kelas', 'kelas.walikelas'])->get();
        return view('admin.siswa.index', compact('data'));
    }

    public function create()
    {
        $kelasList = Kelas::all();
        return view('admin.siswa.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tahun_ajaran' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ], 
        [
            'nis.unique' => 'NIS sudah digunakan.',
            'nis.numeric' => 'NIS harus berupa angka.',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelasList = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelasList'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis,' . $id,
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tahun_ajaran' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nis.unique' => 'NIS sudah digunakan.',
            'nis.numeric' => 'NIS harus berupa angka.',
        ]);

        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}