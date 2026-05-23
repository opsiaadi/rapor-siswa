<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = $this->getCurrentAdmin();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = $this->getCurrentAdmin();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $admin->nama = $request->nama;
        $admin->email = $request->email;

        if ($request->hasFile('foto')) {
            if ($admin->foto) {
                Storage::disk('public')->delete($admin->foto);
            }
            $admin->foto = $request->file('foto')->store('foto-admin', 'public');
        }

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.profile.index')->with('success', 'Profile berhasil diperbarui.');
    }

    public function destroyFoto()
    {
        $admin = $this->getCurrentAdmin();
        if ($admin->foto) {
            Storage::disk('public')->delete($admin->foto);
            $admin->foto = null;
            $admin->save();
        }
        return redirect()->route('admin.profile.index')->with('success', 'Foto profil berhasil dihapus.');
    }
}
