<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class WalikelasController extends Controller
{
    private function getCurrentGuru(): ?Guru
    {
        if (Auth::guard('guru')->check()) {
            return Auth::guard('guru')->user();
        }
        return null;
    }
    
    private function kelas()
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
            $rata_rata = Nilai::where('siswa_id', $s->id)->where('semester', '1')->avg('nilai_akhir');
            $rata_rata = $rata_rata ? round($rata_rata, 1) : '-';
            
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
                'nilai_rata_rata' => $rata_rata,
            ];
        });
    }
    
    private function getSiswa($id, $kelas): ?Siswa
    {
        $kelasIds = $kelas->pluck('id');
        if ($kelasIds->isEmpty()) return null;
        
        return Siswa::where('id', $id)->whereIn('kelas_id', $kelasIds)->first();
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
        $kelas = $this->kelas();
        $sw = $this->getSiswa($siswaId, $kelas);
        if (!$sw) return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');
        
        $guru = $this->getCurrentGuru();
        
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
        $kelas = $this->kelas();
        $sw = $this->getSiswa($siswaId, $kelas);
        if (!$sw) return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');

        $request->validate([
            'keterangan' => 'nullable|string|max:2000',
            'keterangan_extra' => 'nullable|string|max:2000',
            'kegiatan' => 'nullable|string|max:255',
            'ket_kegiatan' => 'nullable|string|max:255',
            'izin' => 'nullable|integer|min:0|max:365',
            'sakit' => 'nullable|integer|min:0|max:365',
            'alpha' => 'nullable|integer|min:0|max:365',
        ]);

        $sw->update([
            'keterangan' => $request->keterangan ?? '',
            'keterangan_extra' => $request->keterangan_extra ?? '',
            'kegiatan' => $request->kegiatan ?? '',
            'ket_kegiatan' => $request->ket_kegiatan ?? '',
            'izin' => $request->izin ?? 0,
            'sakit' => $request->sakit ?? 0,
            'alpha' => $request->alpha ?? 0,
            'status_rapor' => 'sudah',
        ]);
        
        return redirect()->route('walikelas.finalisasi')->with('success', 'Keterangan berhasil disimpan.');
    }

    public function raporLihat($siswaId)
    {
        $kelas = $this->kelas();
        $sw = $this->getSiswa($siswaId, $kelas);
        if (!$sw) return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');

        $guru = $this->getCurrentGuru();

        $semester = request('semester', '1');

        $nilaiList = Nilai::with(['mapel', 'guru'])
            ->where('siswa_id', $siswaId)
            ->where('semester', $semester)
            ->get()
            ->map(function($n) {
                $kkm = $n->mapel->kkm ?? 75;
                $status = $n->nilai_akhir !== null 
                    ? ($n->nilai_akhir >= $kkm ? 'Lulus' : 'Tidak Lulus') 
                    : '-';
                return (object) [
                    'id' => $n->id,
                    'mapel_nama' => $n->mapel->nama_mapel ?? '-',
                    'kkm' => $kkm,
                    'harian' => $n->harian ?? '-',
                    'uts' => $n->uts ?? '-',
                    'uas' => $n->uas ?? '-',
                    'nilai_akhir' => $n->nilai_akhir ?? '-',
                    'status' => $status,
                ];
            });

        $rata_rata = $nilaiList->where('nilai_akhir', '!=', '-')->avg('nilai_akhir');
        $rata_rata = $rata_rata ? round($rata_rata, 2) : '-';

        $waliKelas = $sw->kelas ? $sw->kelas->waliKelas : null;

        return view('walikelas.rapor_lihat', [
            'id' => $guru?->id,
            'namaGuru' => $guru?->nama,
            'siswa' => (object) [
                'id' => $sw->id,
                'nis' => $sw->nis,
                'nama' => $sw->nama,
                'jenis_kelamin' => $sw->jenis_kelamin,
                'tahun_ajaran' => $sw->tahun_ajaran ?? '-',
                'kelas_nama' => $sw->kelas ? $sw->kelas->nama_kelas : '-',
                'keterangan' => $sw->keterangan ?? '',
                'keterangan_extra' => $sw->keterangan_extra ?? '',
                'kegiatan' => $sw->kegiatan ?? '',
                'ket_kegiatan' => $sw->ket_kegiatan ?? '',
                'izin' => $sw->izin ?? 0,
                'sakit' => $sw->sakit ?? 0,
                'alpha' => $sw->alpha ?? 0,
            ],
            'wali_kelas' => $waliKelas ? (object) ['nama' => $waliKelas->nama] : (object) ['nama' => '-'],
            'kelasUtama' => $kelas->first() ? (object) ['nama_kelas' => $kelas->first()->nama_kelas] : (object) [],
            'assignedClasses' => $kelas,
            'nilaiList' => $nilaiList,
            'rata_rata' => $rata_rata,
            'semester' => $semester,
            'semesterList' => ['1' => 'Ganjil', '2' => 'Genap'],
        ]);
    }

    public function exportPdf($siswaId)
    {
        $kelas = $this->kelas();
        $sw = $this->getSiswa($siswaId, $kelas);
        if (!$sw) return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');

        $semester = request('semester', '1');

        $nilaiList = Nilai::with(['mapel', 'guru'])
            ->where('siswa_id', $siswaId)
            ->where('semester', $semester)
            ->get()
            ->map(function($n) {
                $kkm = $n->mapel->kkm ?? 75;
                $status = $n->nilai_akhir !== null
                    ? ($n->nilai_akhir >= $kkm ? 'Lulus' : 'Tidak Lulus')
                    : '-';
                return (object) [
                    'id' => $n->id,
                    'mapel_nama' => $n->mapel->nama_mapel ?? '-',
                    'kkm' => $kkm,
                    'harian' => $n->harian ?? '-',
                    'uts' => $n->uts ?? '-',
                    'uas' => $n->uas ?? '-',
                    'nilai_akhir' => $n->nilai_akhir ?? '-',
                    'status' => $status,
                ];
            });

        $rata_rata = $nilaiList->where('nilai_akhir', '!=', '-')->avg('nilai_akhir');
        $rata_rata = $rata_rata ? round($rata_rata, 2) : '-';

        $waliKelas = $sw->kelas ? $sw->kelas->waliKelas : null;

        $pdf = Pdf::loadView('walikelas.rapor_pdf', [
            'siswa' => (object) [
                'id' => $sw->id,
                'nis' => $sw->nis,
                'nama' => $sw->nama,
                'jenis_kelamin' => $sw->jenis_kelamin,
                'tahun_ajaran' => $sw->tahun_ajaran ?? '-',
                'kelas_nama' => $sw->kelas ? $sw->kelas->nama_kelas : '-',
                'keterangan' => $sw->keterangan ?? '',
                'kegiatan' => $sw->kegiatan ?? '',
                'ket_kegiatan' => $sw->ket_kegiatan ?? '',
                'izin' => $sw->izin ?? 0,
                'sakit' => $sw->sakit ?? 0,
                'alpha' => $sw->alpha ?? 0,
            ],
            'wali_kelas' => $waliKelas ? (object) ['nama' => $waliKelas->nama] : (object) ['nama' => '-'],
            'nilaiList' => $nilaiList,
            'rata_rata' => $rata_rata,
            'semester' => $semester,
            'semesterList' => ['1' => 'Ganjil', '2' => 'Genap'],
        ]);

        $filename = 'Rapor_' . ($sw->nis ?? 'unknown') . '_' . ($sw->nama ?? 'siswa') . '.pdf';

        return $pdf->download($filename);
    }
}