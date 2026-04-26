<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        // TODO: Implement real authentication later
        // For now, simulate login with session
        
        $role = $request->input('role', 'admin');
        
        // Store user info in session (fake auth)
        session([
            'user' => [
                'id' => 1,
                'name' => 'Admin TU',
                'role' => $role,
            ]
        ]);

        // Redirect based on role
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'guru') {
            return redirect()->route('guru.dashboard', ['id' => 1, 'namaGuru' => 'guru']);
        } else {
            return redirect()->route('walikelas.dashboard');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
