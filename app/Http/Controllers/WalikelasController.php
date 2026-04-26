<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FakeDataHelper;

class WalikelasController extends Controller
{
    public function dashboard($id = null, $nama = null) {
        $kelas = null;
        $siswaList = [];
        $stats = FakeDataHelper::getDashboardStats();

        if ($id) {
            $allKelas = FakeDataHelper::getKelas();
            $kelas = collect($allKelas)->firstWhere('id', (int) $id);
            
            if ($kelas) {
                $allSiswa = FakeDataHelper::getSiswa();
                $siswaList = collect($allSiswa)->where('kelas_id', (int) $id)->values()->all();
            }
        }

        return view('pages.walikelas.dashboard', [
            'id' => $id,
            'nama' => $nama ?? 'Wali Kelas',
            'kelas' => $kelas,
            'siswa' => $siswaList,
            'stats' => $stats,
            'mapel' => FakeDataHelper::getMapel(),
        ]);
    }

    public function siswa($id = null, $nama = null) {
        $kelas = null;
        $siswaList = [];

        if ($id) {
            $allKelas = FakeDataHelper::getKelas();
            $kelas = collect($allKelas)->firstWhere('id', (int) $id);
            
            if ($kelas) {
                $allSiswa = FakeDataHelper::getSiswa();
                $siswaList = collect($allSiswa)->where('kelas_id', (int) $id)->values()->all();
            }
        }

        return view('pages.walikelas.siswa', [
            'id' => $id,
            'nama' => $nama ?? 'Wali Kelas',
            'kelas' => $kelas,
            'siswa' => $siswaList,
        ]);
    }

    public function nilai(Request $request, $id = null, $nama = null) {
        $kelas = null;
        $siswaList = [];
        $mapelList = FakeDataHelper::getMapel();
        $savedNilai = session('fake_nilai', []);

        if ($id) {
            $allKelas = FakeDataHelper::getKelas();
            $kelas = collect($allKelas)->firstWhere('id', (int) $id);
            
            if ($kelas) {
                $allSiswa = FakeDataHelper::getSiswa();
                $siswaList = collect($allSiswa)->where('kelas_id', (int) $id)->values()->all();
            }
        }

        if ($request->isMethod('POST')) {
            $nilaiData = $request->all();
            session(['fake_nilai' => $nilaiData]);
            return back()->with('success', 'Nilai berhasil disimpan!')->withInput($nilaiData);
        }

        return view('pages.walikelas.nilai', [
            'id' => $id,
            'nama' => $nama ?? 'Wali Kelas',
            'kelas' => $kelas,
            'siswa' => $siswaList,
            'mapel' => $mapelList,
            'savedNilai' => $savedNilai,
        ]);
    }

    public function rapot($id = null, $nama = null) {
        $kelas = null;
        $siswaList = [];

        if ($id) {
            $allKelas = FakeDataHelper::getKelas();
            $kelas = collect($allKelas)->firstWhere('id', (int) $id);
            
            if ($kelas) {
                $allSiswa = FakeDataHelper::getSiswa();
                $siswaList = collect($allSiswa)->where('kelas_id', (int) $id)->values()->all();
            }
        }

        return view('pages.walikelas.rapot', [
            'id' => $id,
            'nama' => $nama ?? 'Wali Kelas',
            'kelas' => $kelas,
            'siswa' => $siswaList,
        ]);
    }
}