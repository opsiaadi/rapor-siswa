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
                UserRole::Admin => redirect()->route('admin.dashboard', ['id' => $user->id, 'nama' => $user->nama]),
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

            $success = Auth::attempt([$field => $credential, 'password' => $password]);

            if ($success) {
                $user = Auth::user();

                if ($user->role->value !== $role) {
                    Auth::logout();
                    $success = false;
                }

                if ($success && $role === 'walikelas') {
                    $isWalikelas = Kelas::where('wali_kelas_id', $user->id)->exists();
                    if (!$isWalikelas) {
                        Auth::logout();
                        $success = false;
                    }
                }

                if ($success) {
                    return match ($role) {
                        'admin' => redirect()->route('admin.dashboard', ['id' => $user->id, 'nama' => $user->nama]),
                        'walikelas' => redirect()->route('walikelas.dashboard'),
                        default => redirect()->route('guru.dashboard', ['id' => $user->id, 'namaGuru' => $user->nama]),
                    };
                }
            }

            return back()->with('error', 'NIK/Email/Role atau password salah.')->withInput();
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