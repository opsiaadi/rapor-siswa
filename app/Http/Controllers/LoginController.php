<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('role')) {
            $role = $request->input('role');
            $nik = $request->input('nik', 'User');
            
            session(['user' => [
                'id' => 1,
                'name' => $nik,
                'role' => $role,
                'guru_id' => $role !== 'admin' ? 1 : null,
                'admin_id' => $role === 'admin' ? 1 : null,
            ]]);
            
            // Debug: pastikan session tersimpan
            logger('Login success', ['role' => $role, 'session_user' => session('user')]);
            
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard', ['id' => 1, 'nama' => $nik]);
            }
            if ($role === 'guru') {
                return redirect()->route('guru.dashboard');
            }
            return redirect()->route('walikelas.dashboard');
        }
        
        return view('login');
    }
    
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
