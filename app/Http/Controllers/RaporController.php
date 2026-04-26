<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaporController extends Controller
{
    public function finalisasi($id = 1, $nama = 'Wali Kelas') {
        $walikelasNama = session('user.name', 'Wali Kelas');
        return view('pages.walikelas.finalisasi', ['id' => $id, 'nama' => $nama, 'walikelas_nama' => $walikelasNama]);
    }

    public function simpan(Request $request) {
        $data = $request->all();
        
        if ($request->hasFile('ttd')) {
            $data['ttd'] = $request->file('ttd')->store('ttd', 'public');
        }
        
        return back()->with('success', 'Data berhasil disimpan');
    }
}
