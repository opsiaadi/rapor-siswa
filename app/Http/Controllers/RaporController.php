<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaporController extends Controller
{
    public function simpan(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('ttd')) {
            $data['ttd'] = $request->file('ttd')->store('ttd', 'public');
        }

        return back()->with('success', 'Data berhasil disimpan.');
    }
}
