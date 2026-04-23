<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\FakeDataHelper;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // Hitung jumlah siswa per kelas DARI data siswa real (session)
        $siswaPerKelas = [];
        foreach (FakeDataHelper::getSiswa() as $s) {
            $kid = $s['kelas_id'] ?? null;
            if ($kid) {
                $siswaPerKelas[$kid] = ($siswaPerKelas[$kid] ?? 0) + 1;
            }
        }

        $kelas = array_map(fn($k) => (object) array_merge($k, [
            'wali_kelas' => (object) ['id' => $k['wali_kelas_id'] ?? null, 'nama' => $k['wali_nama'] ?? '-'],
            'siswa' => collect(range(1, $siswaPerKelas[$k['id']] ?? 0)),
            'siswa_count' => $siswaPerKelas[$k['id']] ?? 0,
            'mapel' => collect([]),
        ]), FakeDataHelper::getKelas());
        $data = collect($kelas);
        return view('admin.kelas.index', compact('data'));
    }

    public function create()
    {
        $guruList = collect(FakeDataHelper::getGuruOptions());
        $mapelList = collect(FakeDataHelper::getMapelOptions());
        return view('admin.kelas.create', compact('guruList', 'mapelList'));
    }

    public function store(Request $request)
    {
        $data = FakeDataHelper::getKelas();
        $waliId = (int) ($request->wali_kelas_id ?? 0);
        $waliGuru = collect(FakeDataHelper::getGuruOptions())->firstWhere('id', $waliId);
        $waliNama = $waliGuru->nama ?? '-';

        $newId = FakeDataHelper::nextId($data);
        $data[] = [
            'id' => $newId,
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $waliId ?: null,
            'wali_nama' => $waliNama,
            'siswa_count' => 0,
            'mapel_ids' => $request->mapel_ids ?? [],
            'mapel_guru' => $request->mapel_guru ?? [],
        ];
        FakeDataHelper::saveKelas($data);
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = FakeDataHelper::findById(FakeDataHelper::getKelas(), $id);
        if (!$item) return redirect()->route('admin.kelas.index')->with('error', 'Data tidak ditemukan.');
        
        $mapelIds = $item['mapel_ids'] ?? [];
        $mapelGuru = $item['mapel_guru'] ?? [];
        
        $kelas = (object) array_merge($item, [
            'wali_kelas' => (object) ['id' => $item['wali_kelas_id'] ?? null, 'nama' => $item['wali_nama'] ?? '-'],
            'mapel' => collect(array_map(fn($mid) => ['id' => $mid], $mapelIds)),
            'kelasMapel' => collect([]),
        ]);
        
        // Get students in this class
        $allSiswa = FakeDataHelper::getSiswa();
        $siswaList = array_filter($allSiswa, fn($s) => $s['kelas_id'] == $id);
        
        $guruList = collect(FakeDataHelper::getGuruOptions());
        $mapelList = collect(FakeDataHelper::getMapelOptions());
        $currentMapelGuru = $mapelGuru;
        return view('admin.kelas.edit', compact('kelas', 'guruList', 'mapelList', 'currentMapelGuru', 'siswaList'));
    }

    public function update(Request $request, $id)
    {
        $data = FakeDataHelper::getKelas();
        $waliId = (int) ($request->wali_kelas_id ?? 0);
        $waliGuru = collect(FakeDataHelper::getGuruOptions())->firstWhere('id', $waliId);
        $waliNama = $waliGuru ? $waliGuru->nama : '-';

        FakeDataHelper::updateById($data, $id, [
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $waliId ?: null,
            'wali_nama' => $waliNama,
            'mapel_ids' => $request->mapel_ids ?? [],
            'mapel_guru' => $request->mapel_guru ?? [],
        ]);
        FakeDataHelper::saveKelas($data);
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = FakeDataHelper::removeById(FakeDataHelper::getKelas(), $id);
        FakeDataHelper::saveKelas($data);
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
