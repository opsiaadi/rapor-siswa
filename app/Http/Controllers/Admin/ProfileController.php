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
        $user = $this->getCurrentUser();

        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $this->getCurrentUser();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $user->foto = $request->file('foto')->store('foto-admin', 'public');
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.profile.index')->with('success', 'Profile berhasil diperbarui.');
    }

    public function destroyFoto()
    {
        $user = $this->getCurrentUser();
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
            $user->foto = null;
            $user->save();
        }

        return redirect()->route('admin.profile.index')->with('success', 'Foto profil berhasil dihapus.');
    }
}
