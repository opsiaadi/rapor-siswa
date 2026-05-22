<?php

namespace App\Http\Controllers;

use App\Enums\Semester;
use App\Models\KelasMapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Interfaces\GradeProcessor;
use App\Services\NilaiMapperService;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    private GradeProcessor $gradeProcessor;
    private NilaiMapperService $nilaiMapperService;

    public function __construct(GradeProcessor $gradeProcessor, NilaiMapperService $nilaiMapperService)
    {
        $this->gradeProcessor = $gradeProcessor;
        $this->nilaiMapperService = $nilaiMapperService;
    }

    private function getGuruMengajar($guruId)
    {
        return KelasMapel::findByGuruId($guruId)->map(function($m) {
                return (object) [
                    'id' => $m->id,
                    'mapel_id' => $m->mapel_id,
                    'mapel_nama' => $m->mapel->nama_mapel ?? '-',
                    'kelas_id' => $m->kelas_id,
                    'kelas_nama' => $m->kelas->nama_kelas ?? '-',
                    'semester' => '1',
                ];
            });
    }

    public function nama($id = null, $namaGuru = null)
    {
        $guru = $this->getCurrentGuru();
        return view('guru.dashboard_guru', [
            'id' => $guru->id,
            'namaGuru' => $guru->nama,
            'guruMengajar' => $this->getGuruMengajar($guru->id),
        ]);
    }

    public function nilai(Request $request)
    {
        $guru = $this->getCurrentGuru();

        if ($request->isMethod('POST')) {
            $request->validate([
                'nilai' => 'nullable|array',
                'nilai.harian.*' => 'nullable|numeric|min:0|max:100',
                'nilai.uts.*' => 'nullable|numeric|min:0|max:100',
                'nilai.uas.*' => 'nullable|numeric|min:0|max:100',
                'mapel' => 'required',
                'semester' => 'required|in:1,2',
                'mengajar' => 'required',
                'kelas' => 'required',
            ]);

            $key = "nilai_{$guru->id}_{$request->mapel}_{$request->semester}";
            $nilaiSession = $this->nilaiMapperService->saveNilaiFromRequest(
                $request->input('nilai', []),
                $request->mapel,
                $request->semester,
                $guru,
                session($key, [])
            );
            session([$key => $nilaiSession]);

            $message = $request->input('action') === 'kirim' ? 'Nilai terkirim.' : 'Nilai berhasil disimpan.';
            return redirect()->back()->with('success', $message);
        }

        $guruMengajar = $this->getGuruMengajar($guru->id);

        $filter = [
            'mengajarId' => $request->input('mengajar'),
            'kelasId' => $request->input('kelas'),
            'semester' => $request->input('semester', '1'),
            'mapelId' => $request->input('mapel'),
        ];

        if ($filter['mengajarId']) {
            $selected = $guruMengajar->firstWhere('id', $filter['mengajarId']);
            if ($selected) {
                $filter['mapelId'] = $selected->mapel_id;
                $filter['kelasId'] = $selected->kelas_id;
            }
        }

        $kelasList = $guruMengajar->pluck('kelas_nama', 'kelas_id')
            ->map(fn($nama, $id) => (object) ['id' => $id, 'nama_kelas' => $nama])
            ->values();

        $siswaList = $this->nilaiMapperService->buildSiswaNilaiList(
            $filter['kelasId'], $filter['mapelId'], $guru, $filter
        );

        return view('guru.input-nilai', [
            'id' => $guru->id,
            'namaGuru' => $guru->nama,
            'siswaList' => $siswaList,
            'guruMengajar' => $guruMengajar,
            'kelasList' => $kelasList,
            'filter' => $filter,
        ]);
    }

    public function hasilbelajar($id = null, $namaGuru = null)
    {
        return redirect()->route('guru.dashboard', ['id' => $id, 'namaGuru' => $namaGuru])
        ->with('info', 'Halaman hasil belajar belum tersedia.');
    }

    public function daftarRapor()
    {
        $guru = $this->getCurrentGuru();

        $guruMengajar = $this->getGuruMengajar($guru->id);
        $kelasIds = $guruMengajar->pluck('kelas_id')->unique();

        $siswaList = collect();
        if ($kelasIds->isNotEmpty()) {
            $siswaList = Siswa::findWithKelasByKelasIds($kelasIds->toArray())
                ->map(fn($s) => Siswa::toDaftar($s));
        }

        return view('guru.daftar_rapor', [
            'id' => $guru->id,
            'namaGuru' => $guru->nama,
            'siswaList' => $siswaList,
        ]);
    }

    public function lihatRapor($siswaId)
    {
        $guru = $this->getCurrentGuru();

        $guruMengajar = $this->getGuruMengajar($guru->id);
        $kelasIds = $guruMengajar->pluck('kelas_id')->unique();

        $siswa = Siswa::findByIdInKelasIds($siswaId, $kelasIds->toArray());

        if (!$siswa) {
            return redirect()->route('guru.rapor')->with('error', 'Siswa tidak ditemukan.');
        }

        $semester = request('semester', '1');
        $mapelIds = $guruMengajar->pluck('mapel_id')->unique();

        $nilaiModels = Nilai::findBySiswaMapelSemester($siswaId, $mapelIds->toArray(), $semester);

        $nilaiList = $this->nilaiMapperService->mapNilaiList($nilaiModels);
        $rata_rata = $this->nilaiMapperService->calculateRataRata($nilaiList);

        return view('guru.rapor_lihat', [
            'id' => $guru->id,
            'namaGuru' => $guru->nama,
            'siswa' => Siswa::toRaporDetail($siswa),
            'nilaiList' => $nilaiList,
            'rata_rata' => $rata_rata,
            'semester' => $semester,
            'semesterList' => Semester::labels(),
        ]);
    }
}