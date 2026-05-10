<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    private function getCurrentGuru(): ?Guru
    {
        $user = session('user');
        if (!$user || !isset($user['guru_id'])) return null;
        return Guru::find($user['guru_id']);
    }
    
    private function kelas(): \Illuminate\Database\Eloquent\Collection
    {
        $guru = $this->getCurrentGuru();
        if (!$guru) return collect();
        
        return Kelas::where('wali_kelas_id', $guru->id)->get();
    }
    
    private function siswaData($kelas)
    {
        $kelasIds = $kelas->pluck('id');
        if ($kelasIds->isEmpty()) return collect();
        
        return Siswa::whereIn('kelas_id', $kelasIds)->get()->map(function($s) {
            return (object) [
                'id' => $s->id,
                'nis' => $s->nis,
                'nama' => $s->nama,
                'jenis_kelamin' => $s->jenis_kelamin,
                'tahun_ajaran' => $s->tahun_ajaran ?? '-',
                'kelas_id' => $s->kelas_id,
                'kelas' => $s->kelas ? (object) ['nama_kelas' => $s->kelas->nama_kelas] : (object) ['nama_kelas' => '-'],
                'keterangan' => $s->keterangan ?? '',
                'keterangan_extra' => $s->keterangan_extra ?? '',
                'izin' => $s->izin ?? 0,
                'sakit' => $s->sakit ?? 0,
                'alpha' => $s->alpha ?? 0,
                'status_rapor' => $s->status_rapor ?? 'belum',
            ];
        });
    }
    
    private function getSiswa($id): ?Siswa
    {
        return Siswa::find($id);
    }
    
    public function dashboard()
    {
        $guru = $this->getCurrentGuru();
        $kelas = $this->kelas();
        $siswa = $this->siswaData($kelas);
        $kelasUtama = $kelas->first();
        $totalSiswa = $siswa->count();
        
        return view('walikelas.dashboard', [
            'id' => $guru?->id,
            'namaGuru' => $guru?->nama,
            'kelasList' => $kelas,
            'assignedClasses' => $kelas,
            'selectedClass' => $kelasUtama ? (object) ['nama_kelas' => $kelasUtama->nama_kelas] : (object) ['nama_kelas' => '-'],
            'siswaList' => $siswa,
            'totalSiswa' => $totalSiswa,
            'stats' => [
                'kelas_perwalian' => $kelas->count(),
                'total_siswa' => $siswa->count(),
                'mapel_diampu' => $guru ? $guru->mapels->count() : 0,
                'kelas_utama' => $kelasUtama ? $kelasUtama->nama_kelas : '-'
            ]
        ]);
    }
    
    public function finalisasi()
    {
        $guru = $this->getCurrentGuru();
        $kelas = $this->kelas();
        $siswaList = $this->siswaData($kelas);
        $totalSiswa = $siswaList->count();

        return view('walikelas.form_finalisasi', [
            'id' => $guru?->id,
            'namaGuru' => $guru?->nama,
            'assignedClasses' => $kelas,
            'kelasUtama' => $kelas->first() ? (object) ['nama_kelas' => $kelas->first()->nama_kelas] : (object) [],
            'siswaList' => $siswaList,
            'totalSiswa' => $totalSiswa
        ]);
    }
    
    public function siswa()
    {
        $guru = $this->getCurrentGuru();
        $kelas = $this->kelas();

        return view('walikelas.data_siswa', [
            'id' => $guru?->id,
            'namaGuru' => $guru?->nama,
            'siswaList' => $this->siswaData($kelas),
            'totalSiswa' => $this->siswaData($kelas)->count(),
            'assignedClasses' => $kelas,
            'kelasUtama' => $kelas->first() ? (object) ['nama_kelas' => $kelas->first()->nama_kelas] : (object) []
        ]);
    }
    
    public function rapor($siswaId)
    {
        $sw = $this->getSiswa($siswaId);
        if (!$sw) return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');
        
        $guru = $this->getCurrentGuru();
        $kelas = $this->kelas();
        
        return view('walikelas.rapor_siswa', [
            'id' => $guru?->id,
            'namaGuru' => $guru?->nama,
            'siswa' => (object) [
                'id' => $sw->id,
                'nis' => $sw->nis,
                'nama' => $sw->nama,
                'jenis_kelamin' => $sw->jenis_kelamin,
                'tahun_ajaran' => $sw->tahun_ajaran ?? '-',
                'kelas_id' => $sw->kelas_id,
                'kelas' => $sw->kelas ? (object) ['nama_kelas' => $sw->kelas->nama_kelas] : (object) ['nama_kelas' => '-'],
                'keterangan' => $sw->keterangan ?? '',
                'keterangan_extra' => $sw->keterangan_extra ?? '',
                'izin' => $sw->izin ?? 0,
                'sakit' => $sw->sakit ?? 0,
                'alpha' => $sw->alpha ?? 0,
            ],
            'kelasUtama' => $kelas->first() ? (object) ['nama_kelas' => $kelas->first()->nama_kelas] : (object) [],
            'assignedClasses' => $kelas,
            'nilaiList' => collect([]),
        ]);
    }
    
    public function simpanKeterangan(Request $request, $siswaId)
    {
        $sw = $this->getSiswa($siswaId);
        if (!$sw) return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');
        
        $sw->update([
            'keterangan' => $request->keterangan ?? '',
            'keterangan_extra' => $request->keterangan_extra ?? '',
            'kegatan' => $request->kegatan ?? '',
            'ket_kegatan' => $request->ket_kegatan ?? '',
            'izin' => $request->izin ?? 0,
            'sakit' => $request->sakit ?? 0,
            'alpha' => $request->alpha ?? 0,
            'status_rapor' => 'sudah',
        ]);
        
        return redirect()->route('walikelas.finalisasi')->with('success', 'Keterangan berhasil disimpan.');
    }
}