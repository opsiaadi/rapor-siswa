<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{

    function nama($id = 'GR001', $namaGuru = 'Guru Mapel') {
        return view('dashboard_guru', ['id' => $id, 'namaGuru' => $namaGuru]);
    }
}
