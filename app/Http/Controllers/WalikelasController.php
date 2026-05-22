<?php

namespace App\Http\Controllers;

use App\Enums\Semester;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Mapel;
use App\Interfaces\GradeProcessor;
use App\Services\NilaiMapperService;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    private GradeProcessor $gradeProcessor;
    private NilaiMapperService $nilaiMapperService;

    public function __construct(GradeProcessor $gradeProcessor, NilaiMapperService $nilaiMapperService)
    {
        $this->gradeProcessor = $gradeProcessor;
        $this->nilaiMapperService = $nilaiMapperService;
    }
    
    private function kelas()
    {
        $guru = $this->getCurrentGuru();
        if (!$guru) return collect();

        return Kelas::findByWaliKelasId($guru->id);
    }
    
    private function siswaData($kelas)
    {
        $kelasIds = $kelas->pluck('id');
        if ($kelasIds->isEmpty()) return collect();

        return Siswa::findWithKelasByKelasIds($kelasIds->toArray())
            ->map(fn($s) => Siswa::toDataSiswa($s, Nilai::getRataRata($s->id, '1')));
    }
    
    private function kelasUtama($kelas): object
    {
        return $kelas->first()
            ? (object) ['nama_kelas' => $kelas->first()->nama_kelas]
            : (object) ['nama_kelas' => '-'];
    }

    private function getSiswa($id, $kelas): ?Siswa
    {
        $kelasIds = $kelas->pluck('id');
        if ($kelasIds->isEmpty()) return null;

        return Siswa::findByIdInKelasIds($id, $kelasIds->toArray());
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
            'selectedClass' => $this->kelasUtama($kelas),
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
            'kelasUtama' => $this->kelasUtama($kelas),
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
            'kelasUtama' => $this->kelasUtama($kelas),
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

        $nilaiModels = Nilai::findBySiswaSemester($siswaId, $semester);
        $nilaiList = $this->nilaiMapperService->mapNilaiList($nilaiModels);
        $rata_rata = $this->nilaiMapperService->calculateRataRata($nilaiList);

        $waliKelas = $sw->kelas ? $sw->kelas->waliKelas : null;

        return view('walikelas.rapor_lihat', [
            'id' => $guru?->id,
            'namaGuru' => $guru?->nama,
            'siswa' => Siswa::toRaporDetail($sw),
            'wali_kelas' => $waliKelas ? (object) ['nama' => $waliKelas->nama] : (object) ['nama' => '-'],
            'kelasUtama' => $this->kelasUtama($kelas),
            'assignedClasses' => $kelas,
            'nilaiList' => $nilaiList,
            'rata_rata' => $rata_rata,
            'semester' => $semester,
            'semesterList' => Semester::labels(),
        ]);
    }

    public function cetakRapor($siswaId)
    {
        $kelas = $this->kelas();
        $sw = $this->getSiswa($siswaId, $kelas);
        if (!$sw) return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');

        $semester = request('semester', '1');

        $nilaiModels = Nilai::findBySiswaSemester($siswaId, $semester);
        $nilaiList = $this->nilaiMapperService->mapNilaiList($nilaiModels);
        $rata_rata = $this->nilaiMapperService->calculateRataRata($nilaiList);

        $waliKelas = $sw->kelas ? $sw->kelas->waliKelas : null;

        return view('walikelas.cetak_rapor', [
            'siswa' => Siswa::toRaporDetail($sw),
            'wali_kelas' => $waliKelas ? (object) ['nama' => $waliKelas->nama] : (object) ['nama' => '-'],
            'nilaiList' => $nilaiList,
            'rata_rata' => $rata_rata,
            'semester' => $semester,
            'semesterList' => Semester::labels(),
        ]);
    }
}