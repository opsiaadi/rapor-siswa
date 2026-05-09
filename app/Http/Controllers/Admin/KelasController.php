<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\KelasMapel;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
        return view('admin.kelas.index', compact('data'));
    }

    public function create()
    {
        $guruList = Guru::with('mapels')->get();
        $mapelList = Mapel::all();
        
        // Build mapel_id => [guru_id, ...] mapping from guru_mapel table
        $mapelGuruMap = [];
        foreach ($guruList as $guru) {
            foreach ($guru->mapels as $mapel) {
                if (!isset($mapelGuruMap[$mapel->id])) {
                    $mapelGuruMap[$mapel->id] = [];
                }
                $mapelGuruMap[$mapel->id][] = $guru->id;
            }
        }
        
        $currentMapelGuru = [];
        return view('admin.kelas.create', compact('guruList', 'mapelList', 'currentMapelGuru', 'mapelGuruMap'));
    }

    public function edit($id)
    {
        $kelas = Kelas::with(['kelasMapels.guru', 'kelasMapels.mapel'])->findOrFail($id);
        $guruList = Guru::with('mapels')->get();
        $mapelList = Mapel::all();
        
        // Build current mapel_guru mapping
        $currentMapelGuru = [];
        foreach ($kelas->kelasMapels as $km) {
            $currentMapelGuru[$km->mapel_id] = $km->guru_id;
        }
        
        // Build mapel_guru map for JS
        $mapelGuruMap = [];
        foreach ($guruList as $guru) {
            foreach ($guru->mapels as $mapel) {
                if (!isset($mapelGuruMap[$mapel->id])) {
                    $mapelGuruMap[$mapel->id] = [];
                }
                $mapelGuruMap[$mapel->id][] = $guru->id;
            }
        }
        
        return view('admin.kelas.edit', compact('kelas', 'guruList', 'mapelList', 'currentMapelGuru', 'mapelGuruMap'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
        ]);

        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id ?: null,
        ]);

        // Save mapel and guru pengampu to kelas_mapel
        if ($request->mapel_ids) {
            foreach ($request->mapel_ids as $mapelId) {
                $guruId = $request->mapel_guru[$mapelId] ?? null;
                if ($guruId) {
                    KelasMapel::create([
                        'kelas_id' => $kelas->id,
                        'mapel_id' => $mapelId,
                        'guru_id' => $guruId,
                    ]);
                }
            }
        }

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id ?: null,
        ]);

        // Update kelas_mapel entries
        // First delete existing
        KelasMapel::where('kelas_id', $id)->delete();

        // Then create new entries
        if ($request->mapel_ids) {
            foreach ($request->mapel_ids as $mapelId) {
                $guruId = $request->mapel_guru[$mapelId] ?? null;
                if ($guruId) {
                    KelasMapel::create([
                        'kelas_id' => $kelas->id,
                        'mapel_id' => $mapelId,
                        'guru_id' => $guruId,
                    ]);
                }
            }
        }

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        
        // Delete related kelas_mapel first
        KelasMapel::where('kelas_id', $id)->delete();
        
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}