<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    function nama ($id = 'WK001', $nama = 'Wali Kelas') {
        return view('dashboard_walikelas', ['id' => $id, 'nama' => $nama]);
    }
}
