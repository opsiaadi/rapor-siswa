<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mapel;
use Illuminate\Http\Request;

class GuruDataController extends Controller
{
    public function index()
    {
        $data = User::whereIn('role', ['guru', 'walikelas'])->with('mapels')->get();
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
            'nik' => 'required|unique:users,nik',
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'nik.unique'          => 'Nik sudah digunakan',
            'email.unique'        => 'Email sudah digunakan.',
            'password.min'        => 'Password minimal 8 karakter.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'guru',
        ]);

        if ($request->has('mapel_ids')) {
            $user->mapels()->sync($request->mapel_ids);
        }

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::with('mapels')->findOrFail($id);
        $mapelList = Mapel::all();
        return view('admin.guru.edit', compact('user', 'mapelList'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:users,nik,' . $id,
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
        ], [
            'nik.unique'      => 'NIK sudah digunakan.',
            'email.unique'    => 'Email sudah digunakan.',
            'password.min'    => 'Password minimal 8 karakter.',
        ]);

        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'name' => $request->nama,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        if ($request->has('mapel_ids')) {
            $user->mapels()->sync($request->mapel_ids);
        } else {
            $user->mapels()->sync([]);
        }

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
