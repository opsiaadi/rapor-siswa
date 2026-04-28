<?php

namespace App\Http\Controllers;

use App\Helpers\FakeDataHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class WalikelasController extends Controller
{
    private int $gid = 1;
    private string $gnm = 'Drs. Suryanto';

    private function guru(): array
    {
        $g = FakeDataHelper::findById(FakeDataHelper::getGuru(), $this->gid);
        return ['id' => $this->gid, 'nama' => $g['nama'] ?? $this->gnm];
    }

    private function kelas(): Collection
    {
        $g = $this->guru();
        $ls = collect(FakeDataHelper::getKelasOptions());
        $f = $ls->filter(fn($k) => 
            (int) ($k->wali_kelas_id ?? 0) === (int) $g['id'] ||
            strcasecmp($k->wali_nama ?? '', $g['nama']) === 0
        );
        return $f->isNotEmpty() ? $f->values() : $ls->take(1)->values();
    }

    private function siswaData(Collection $k): Collection
    {
        $ids = $k->pluck('id')->all();
        return collect(FakeDataHelper::getSiswa())
            ->filter(fn($s) => in_array($s['kelas_id'] ?? null, $ids, true))
            ->map(fn($s) => (object) $s);
    }

    private function getSiswa($id): ?object
    {
        return $this->siswaData($this->kelas())->firstWhere('id', (int) $id);
    }

    private function updateSiswa($id, $data, $route)
    {
        $rows = FakeDataHelper::getSiswa();
        foreach ($rows as $i => $row) {
            if ($row['id'] == $id) {
                foreach ($data as $f => $v) { $rows[$i][$f] = $v; }
                FakeDataHelper::saveSiswa($rows);
                $msg = $route == 'walikelas.siswa' ? 'Keterangan' : 'Finalisasi rapor';
                return redirect()->route($route)->with('success', $msg.' berhasil disimpan.');
            }
        }
        return redirect()->route($route)->with('error', 'Siswa tidak ditemukan.');
    }

    public function dashboard()
    {
        $g = $this->guru(); $k = $this->kelas(); $s = $this->siswaData($k); $e = $k->first();
        return view('walikelas.dashboard', [
            'id' => $g['id'], 'namaGuru' => $g['nama'],
            'kelasList' => FakeDataHelper::getKelasOptions(),
            'assignedClasses' => $k, 'selectedClass' => $e, 'siswaList' => $s,
            'stats' => [
                'kelas_perwalian' => $k->count(), 'total_siswa' => $s->count(),
                'mapel_diampu' => count(FakeDataHelper::getMapelByGuru($this->gid)),
                'kelas_utama' => $e->nama_kelas ?? '-'
            ]
        ]);
    }

    public function finalisasi()
    {
        $g = $this->guru(); $k = $this->kelas();
        return view('walikelas.form_finalisasi', [
            'id' => $g['id'], 'namaGuru' => $g['nama'],
            'assignedClasses' => $k, 'kelasUtama' => $k->first()
        ]);
    }

    public function siswa()
    {
        $g = $this->guru(); $k = $this->kelas();
        return view('walikelas.data_siswa', [
            'id' => $g['id'], 'namaGuru' => $g['nama'],
            'siswaList' => $this->siswaData($k), 'assignedClasses' => $k,
            'kelasUtama' => $k->first()
        ]);
    }

    public function rapor($siswaId)
    {
        $sw = $this->getSiswa($siswaId);
        if (!$sw) return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');
        $g = $this->guru(); $k = $this->kelas();
        return view('walikelas.rapor_siswa', [
            'id' => $g['id'], 'namaGuru' => $g['nama'],
            'siswa' => $sw, 'kelasUtama' => $k->first(), 'assignedClasses' => $k
        ]);
    }

    public function simpanKeterangan(Request $request, $siswaId)
    {
        return $this->updateSiswa($siswaId, $request->validate([
            'keterangan' => 'required|string|max:1000',
            'kegiatan' => 'nullable|string|max:255',
            'ket_kegiatan' => 'nullable|string|max:255',
            'izin' => 'nullable|integer|min:0',
            'sakit' => 'nullable|integer|min:0',
            'alpha' => 'nullable|integer|min:0',
        ]), 'walikelas.finalisasi');
    }
}
