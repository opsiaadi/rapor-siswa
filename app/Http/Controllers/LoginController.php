<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $role = $request->input('role', 'admin');
        
        $userData = [
            'id' => 1,
            'role' => $role,
        ];
        
        if ($role === 'admin') {
            $userData['name'] = 'Admin TU';
            $redirect = redirect()->route('admin.dashboard');
        } elseif ($role === 'guru') {
            $userData['name'] = 'Guru';
            $redirect = redirect()->route('guru.dashboard', ['id' => 1, 'namaGuru' => 'Guru']);
        } else {
            $userData['name'] = 'Wali Kelas';
            $redirect = redirect()->route('walikelas.dashboard', ['id' => 1, 'nama' => 'Wali Kelas']);
        }
        
        session(['user' => $userData]);
        
        return $redirect;
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
