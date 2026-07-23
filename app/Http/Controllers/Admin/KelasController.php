<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasMapel;
use App\Models\Mapel;
use App\Models\User;
use App\Notifications\KelasNotification;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::with('waliKelas')->get();

        return view('admin.kelas.index', compact('data'));
    }

    public function create()
    {
        $guruList = User::whereIn('role', ['guru', 'walikelas'])->with('mapels')->get();
        $mapelList = Mapel::all();

        $mapelGuruMap = $guruList->flatMap(function ($guru) {
            return $guru->mapels->map(function ($mapel) use ($guru) {
                return ['mapel_id' => $mapel->id, 'guru_id' => $guru->id];
            });
        })->groupBy('mapel_id')->map(function ($group) {
            return $group->pluck('guru_id')->toArray();
        })->toArray();

        $currentMapelGuru = [];

        $waliTerpakai = Kelas::whereNotNull('wali_kelas_id')->pluck('wali_kelas_id');

        return view('admin.kelas.create', compact('guruList', 'mapelList', 'currentMapelGuru', 'mapelGuruMap', 'waliTerpakai'));
    }

    public function edit($id)
    {
        $kelas = Kelas::with(['siswa', 'kelasMapels.guru', 'kelasMapels.mapel'])->findOrFail($id);
        $guruList = User::whereIn('role', ['guru', 'walikelas'])->with('mapels')->get();
        $mapelList = Mapel::all();

        $siswaList = $kelas->siswa;
        $currentMapelGuru = $kelas->kelasMapels->pluck('guru_id', 'mapel_id')->toArray();

        $mapelGuruMap = $guruList->flatMap(function ($guru) {
            return $guru->mapels->map(function ($mapel) use ($guru) {
                return ['mapel_id' => $mapel->id, 'guru_id' => $guru->id];
            });
        })->groupBy('mapel_id')->map(function ($group) {
            return $group->pluck('guru_id')->toArray();
        })->toArray();

        $waliTerpakai = Kelas::whereNotNull('wali_kelas_id')
            ->where('id', '!=', $kelas->id)
            ->pluck('wali_kelas_id');

        return view('admin.kelas.edit', compact('kelas', 'siswaList', 'guruList', 'mapelList', 'currentMapelGuru', 'mapelGuruMap', 'waliTerpakai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'wali_kelas_id' => 'nullable|unique:kelas,wali_kelas_id',
        ], [
            'wali_kelas_id.unique' => 'Guru tersebut sudah menjadi wali kelas pada kelas lain.',
        ]);

        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id ?: null,
        ]);

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

        $user = $this->getCurrentUser();
        $user->notify(new KelasNotification('tambah', $kelas->nama_kelas, route('admin.kelas.index')));

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'wali_kelas_id' => 'nullable|unique:kelas,wali_kelas_id,'.$kelas->id,
        ], [
            'wali_kelas_id.unique' => 'Guru tersebut sudah menjadi wali kelas pada kelas lain.',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id ?: null,
        ]);

        KelasMapel::where('kelas_id', $id)->delete();

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

        $user = $this->getCurrentUser();
        $user->notify(new KelasNotification('ubah', $kelas->nama_kelas, route('admin.kelas.index')));

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        KelasMapel::where('kelas_id', $id)->delete();
        $kelas->delete();

        $user = $this->getCurrentUser();
        $user->notify(new KelasNotification('hapus', $kelas->nama_kelas, route('admin.kelas.index')));

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
