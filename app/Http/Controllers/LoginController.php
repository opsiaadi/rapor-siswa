<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            return match ($user->role) {
                UserRole::Admin, UserRole::SuperAdmin => redirect()->route('admin.dashboard', ['id' => $user->id, 'nama' => $user->nama]),
                UserRole::Walikelas => redirect()->route('walikelas.dashboard'),
                default => redirect()->route('guru.dashboard', ['id' => $user->id, 'namaGuru' => $user->nama]),
            };
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'role' => 'required|in:admin,guru,walikelas',
                'nik' => 'required|string',
                'password' => 'required|string|min:6',
            ]);

            $role = $request->input('role');
            $credential = $request->input('nik');
            $password = $request->input('password');
            $field = $role === 'admin' ? 'email' : 'nik';

            if (Auth::attempt([$field => $credential, 'password' => $password])) {
                $user = Auth::user();

                if ($role === 'walikelas') {
                    $isWalikelas = Kelas::where('wali_kelas_id', $user->id)->exists();
                    if (!$isWalikelas) {
                        Auth::logout();
                        return back()->with('error', 'Anda tidak terdaftar sebagai wali kelas.');
                    }
                }

                return match ($role) {
                    'admin' => redirect()->route('admin.dashboard', ['id' => $user->id, 'nama' => $user->nama]),
                    'walikelas' => redirect()->route('walikelas.dashboard'),
                    default => redirect()->route('guru.dashboard', ['id' => $user->id, 'namaGuru' => $user->nama]),
                };
            }

            return back()->with('error', 'NIK/Email atau password salah.')->withInput();
        }

        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
