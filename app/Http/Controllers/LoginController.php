<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            return redirect()->route('admin.dashboard', ['id' => $admin->id, 'nama' => $admin->nama]);
        }
        if (Auth::guard('guru')->check()) {
            $role = session('role', 'guru');
            return $role === 'walikelas'
                ? redirect()->route('walikelas.dashboard')
                : redirect()->route('guru.dashboard');
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'role' => 'required|in:admin,guru,walikelas',
                'nik' => 'required|string',
                'password' => 'required|string|min:6',
            ]);

            $role = $request->input('role');
            $nik = $request->input('nik');
            $password = $request->input('password');

            $limiterKey = $role . '|' . $nik;

            if (RateLimiter::tooManyAttempts('login:' . $limiterKey, 5)) {
                $seconds = RateLimiter::availableIn('login:' . $limiterKey);
                return back()->with('error', 'Terlalu banyak percobaan login. Akun Anda dikunci sementara. Silakan coba lagi dalam ' . $seconds . ' detik.');
            }

            if ($role === 'admin') {
                if (Auth::guard('admin')->attempt(['email' => $nik, 'password' => $password])) {
                    RateLimiter::clear('login:' . $limiterKey);
                    $admin = Auth::guard('admin')->user();
                    session(['role' => 'admin']);
                    return redirect()->route('admin.dashboard', ['id' => $admin->id, 'nama' => $admin->nama]);
                }
            } else {
                if (Auth::guard('guru')->attempt(['nik' => $nik, 'password' => $password])) {
                    RateLimiter::clear('login:' . $limiterKey);
                    $guru = Auth::guard('guru')->user();
                    session(['role' => $role]);

                    if ($role === 'walikelas') {
                        $isWalikelas = Kelas::where('wali_kelas_id', $guru->id)->exists();
                        if (!$isWalikelas) {
                            Auth::guard('guru')->logout();
                            return back()->with('error', 'Anda tidak terdaftar sebagai wali kelas.');
                        }
                    }

                    return $role === 'walikelas'
                        ? redirect()->route('walikelas.dashboard')
                        : redirect()->route('guru.dashboard');
                }
            }

            RateLimiter::hit('login:' . $limiterKey);

            return back()->with('error', 'NIK/Email atau password salah.')->withInput();
        }

        return view('login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('guru')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
