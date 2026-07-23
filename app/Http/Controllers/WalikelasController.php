<?php

namespace App\Http\Controllers;

use App\Enums\Semester;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Notifications\RaporDifinalisasi;
use App\Services\NilaiMapperService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    private NilaiMapperService $nilaiMapperService;

    public function __construct(NilaiMapperService $nilaiMapperService)
    {
        $this->nilaiMapperService = $nilaiMapperService;
    }

    private function kelas()
    {
        $user = $this->getCurrentUser();
        if (! $user) {
            return collect();
        }

        return Kelas::findByWaliKelasId($user->id);
    }

    private function siswaData($kelas)
    {
        $kelasIds = $kelas->pluck('id');
        if ($kelasIds->isEmpty()) {
            return collect();
        }

        return Siswa::findWithKelasByKelasIds($kelasIds->toArray())
            ->map(fn ($s) => Siswa::toDataSiswa($s, Nilai::getRataRata($s->id, '1')));
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
        if ($kelasIds->isEmpty()) {
            return null;
        }

        return Siswa::findByIdInKelasIds($id, $kelasIds->toArray());
    }

    public function dashboard()
    {
        $user = $this->getCurrentUser();
        $kelas = $this->kelas();
        $siswa = $this->siswaData($kelas);

        return view('walikelas.dashboard', [
            'id' => $user?->id,
            'namaGuru' => $user?->nama,
            'selectedClass' => $this->kelasUtama($kelas),
            'totalSiswa' => $siswa->count(),
            'stats' => [
                'kelas_perwalian' => $kelas->count(),
                'mapel_diampu' => $user ? $user->mapels->count() : 0,
            ],
        ]);
    }

    public function finalisasi()
    {
        $user = $this->getCurrentUser();
        $kelas = $this->kelas();
        $siswaList = $this->siswaData($kelas);

        return view('walikelas.form_finalisasi', [
            'id' => $user?->id,
            'namaGuru' => $user?->nama,
            'siswaList' => $siswaList,
            'totalSiswa' => $siswaList->count(),
        ]);
    }

    public function siswa()
    {
        $user = $this->getCurrentUser();
        $kelas = $this->kelas();

        return view('walikelas.data_siswa', [
            'id' => $user?->id,
            'namaGuru' => $user?->nama,
            'siswaList' => $this->siswaData($kelas),
            'totalSiswa' => $this->siswaData($kelas)->count(),
            'nilaiList' => collect([]),
        ]);
    }

    public function simpanRapor(Request $request, $siswaId)
    {
        $kelas = $this->kelas();
        $sw = $this->getSiswa($siswaId, $kelas);
        if (! $sw) {
            return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');
        }

        $semester = $request->input('semester', '2');

        $validated = $request->validate([
            'keterangan' => 'nullable|string|max:2000',
            'keterangan_extra' => 'nullable|string|max:2000',
            'kegiatan' => 'nullable|string|max:255',
            'ket_kegiatan' => 'nullable|string|max:255',
            'izin' => 'nullable|integer|min:0|max:365',
            'sakit' => 'nullable|integer|min:0|max:365',
            'alpha' => 'nullable|integer|min:0|max:365',
        ]);

        $nonAbsensi = collect($validated)->except(['izin', 'sakit', 'alpha'])->toArray();
        $sw->update($nonAbsensi + ['status_rapor' => 'sudah']);

        $sw->setAbsensi(
            $semester,
            (int) ($validated['izin'] ?? 0),
            (int) ($validated['sakit'] ?? 0),
            (int) ($validated['alpha'] ?? 0)
        );

        $this->notifyFinalisasi($sw);

        return redirect()->route('walikelas.finalisasi')->with('success', 'Keterangan berhasil disimpan.');
    }

    public function rapor($siswaId)
    {
        $kelas = $this->kelas();
        $sw = $this->getSiswa($siswaId, $kelas);
        if (! $sw) {
            return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');
        }

        $user = $this->getCurrentUser();
        $semester = request('semester', '2');
        $absensi = $sw->getAbsensi($semester);

        return view('walikelas.rapor_siswa', [
            'id' => $user?->id,
            'namaGuru' => $user?->nama,
            'siswa' => $sw,
            'kelasUtama' => $this->kelasUtama($kelas),
            'mode' => 'tambah',
            'semester' => $semester,
            'semesterList' => Semester::labels(),
            'absensi' => $absensi,
            'kegiatanList' => Ekstrakurikuler::aktif()->pluck('nama'),
        ]);
    }

    public function editRapor($siswaId)
    {
        $kelas = $this->kelas();
        $sw = $this->getSiswa($siswaId, $kelas);
        if (! $sw) {
            return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');
        }

        $user = $this->getCurrentUser();
        $semester = request('semester', '2');
        $absensi = $sw->getAbsensi($semester);

        return view('walikelas.rapor_siswa', [
            'id' => $user?->id,
            'namaGuru' => $user?->nama,
            'siswa' => $sw,
            'kelasUtama' => $this->kelasUtama($kelas),
            'mode' => 'edit',
            'semester' => $semester,
            'semesterList' => Semester::labels(),
            'absensi' => $absensi,
            'kegiatanList' => Ekstrakurikuler::aktif()->pluck('nama'),
        ]);
    }

    public function lihatRapor($siswaId)
    {
        $kelas = $this->kelas();
        $sw = $this->getSiswa($siswaId, $kelas);
        if (! $sw) {
            return redirect()->route('walikelas.siswa')->with('error', 'Siswa tidak ditemukan.');
        }

        $semester = request('semester', '2');
        $absensi = $sw->getAbsensi($semester);
        $mapels = $sw->kelas?->mapels ?? collect();
        $nilaiModels = Nilai::findBySiswaMapelSemester(
            $siswaId, $mapels->pluck('id')->toArray(), $semester
        );
        $nilaiList = $this->nilaiMapperService->mapNilaiListByMapel($mapels, $nilaiModels);

        $data = [
            'siswa' => Siswa::toRaporDetail($sw, $semester),
            'wali_kelas' => $sw->kelas?->waliKelas
                ? (object) ['nama' => $sw->kelas->waliKelas->nama]
                : (object) ['nama' => '-'],
            'nilaiList' => $nilaiList,
            'rata_rata' => $this->nilaiMapperService->calculateRataRata($nilaiList),
            'semester' => $semester,
            'semesterList' => Semester::labels(),
            'absensi' => $absensi,
        ];

        if (request()->route()->named('walikelas.cetak.rapor')) {
            return Pdf::loadView('walikelas.rapor_pdf', $data)->download('rapor-'.$sw->nama.'-'.$semester.'.pdf');
        }

        $user = $this->getCurrentUser();
        $data['id'] = $user?->id;
        $data['namaGuru'] = $user?->nama;
        $data['kelasUtama'] = $this->kelasUtama($kelas);

        return view('walikelas.rapor_lihat', $data);
    }

    // notifikasi finalisasi rapor ke admin
    private function notifyFinalisasi(Siswa $siswa): void
    {
        $waliUser = $this->getCurrentUser();
        $kelasNama = $siswa->kelas?->nama_kelas ?? '-';
        NotificationController::notifyAdmins(new RaporDifinalisasi($waliUser->nama, $siswa->nama, $kelasNama));
    }
}
