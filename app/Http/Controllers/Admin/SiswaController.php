<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\FakeDataHelper;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $kelasData = FakeDataHelper::getKelasOptions();
        $siswa = array_map(function($s) use ($kelasData) {
            $kelasObj = collect($kelasData)->firstWhere('id', $s['kelas_id'] ?? null);
            return (object) array_merge($s, [
                'kelas' => (object) ['id' => $s['kelas_id'] ?? null, 'nama_kelas' => $s['kelas_nama'] ?? '-'],
                'wali_nama' => $kelasObj->wali_nama ?? '-',
            ]);
        }, FakeDataHelper::getSiswa());
        $data = collect($siswa);
        return view('admin.siswa.index', compact('data'));
    }

    public function create()
    {
        // Always get latest kelas from shared session
        $kelasList = collect(FakeDataHelper::getKelasOptions());
        return view('admin.siswa.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $data = FakeDataHelper::getSiswa();
        $kelasId = (int) $request->kelas_id;
        $kelas = collect(FakeDataHelper::getKelasOptions())->firstWhere('id', $kelasId);
        $kelasNama = $kelas ? $kelas->nama_kelas : 'Kelas #' . $kelasId;

        $data[] = [
            'id' => FakeDataHelper::nextId($data),
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kelas_id' => $kelasId,
            'kelas_nama' => $kelasNama,
        ];
        FakeDataHelper::saveSiswa($data);

        // Update siswa_count on kelas
        $kelasData = FakeDataHelper::getKelas();
        foreach ($kelasData as $key => $k) {
            if ($k['id'] == $kelasId) {
                $kelasData[$key]['siswa_count'] = ($k['siswa_count'] ?? 0) + 1;
                break;
            }
        }
        FakeDataHelper::saveKelas($kelasData);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = FakeDataHelper::findById(FakeDataHelper::getSiswa(), $id);
        if (!$item) return redirect()->route('admin.siswa.index')->with('error', 'Data tidak ditemukan.');
        $siswa = (object) array_merge($item, [
            'kelas' => (object) ['id' => $item['kelas_id'] ?? null, 'nama_kelas' => $item['kelas_nama'] ?? '-'],
        ]);
        $kelasList = collect(FakeDataHelper::getKelasOptions());
        return view('admin.siswa.edit', compact('siswa', 'kelasList'));
    }

    public function update(Request $request, $id)
    {
        $siswaData = FakeDataHelper::getSiswa();
        $kelasId = (int) $request->kelas_id;
        $kelas = collect(FakeDataHelper::getKelasOptions())->firstWhere('id', $kelasId);
        $kelasNama = $kelas ? $kelas->nama_kelas : 'Kelas #' . $kelasId;

        // Find old kelas_id to decrement its count
        $oldItem = collect($siswaData)->firstWhere('id', (int) $id);
        $oldKelasId = $oldItem['kelas_id'] ?? null;

        FakeDataHelper::updateById($siswaData, $id, [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kelas_id' => $kelasId,
            'kelas_nama' => $kelasNama,
        ]);
        FakeDataHelper::saveSiswa($siswaData);

        // Update kelas counts
        $kelasData = FakeDataHelper::getKelas();
        if ($oldKelasId && $oldKelasId != $kelasId) {
            foreach ($kelasData as $key => $k) {
                if ($k['id'] == $oldKelasId) {
                    $kelasData[$key]['siswa_count'] = max(0, ($k['siswa_count'] ?? 0) - 1);
                }
                if ($k['id'] == $kelasId) {
                    $kelasData[$key]['siswa_count'] = ($k['siswa_count'] ?? 0) + 1;
                }
            }
        }
        FakeDataHelper::saveKelas($kelasData);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswaData = FakeDataHelper::getSiswa();
        $item = collect($siswaData)->firstWhere('id', (int) $id);
        $kelasId = $item['kelas_id'] ?? null;

        $data = FakeDataHelper::removeById($siswaData, $id);
        FakeDataHelper::saveSiswa($data);

        // Decrement kelas count
        if ($kelasId) {
            $kelasData = FakeDataHelper::getKelas();
            foreach ($kelasData as $key => $k) {
                if ($k['id'] == $kelasId) {
                    $kelasData[$key]['siswa_count'] = max(0, ($k['siswa_count'] ?? 0) - 1);
                    break;
                }
            }
            FakeDataHelper::saveKelas($kelasData);
        }

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
