<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\KelasMapel;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    private function getCurrentGuru(): ?Guru
    {
        if (Auth::guard('guru')->check()) {
            return Auth::guard('guru')->user();
        }
        return null;
    }

    private function getGuruMengajar($guruId)
    {
        return KelasMapel::with(['mapel', 'kelas'])
            ->where('guru_id', $guruId)
            ->whereNotNull('guru_id')
            ->get()
            ->map(function($m) {
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
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Guru tidak ditemukan.');
        }
        return view('guru.dashboard_guru', [
            'id' => $guru->id,
            'namaGuru' => $guru->nama,
            'guruMengajar' => $this->getGuruMengajar($guru->id),
        ]);
    }

    public function nilai(Request $request)
    {
        $guru = $this->getCurrentGuru();
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Guru tidak ditemukan.');
        }

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

            $action = $request->input('action');
            $this->simpanNilai($request);
            if ($action === 'kirim') {
                return redirect()->back()->with('success', 'Nilai terkirim.');
            }
            return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
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

        $key = "nilai_{$guru->id}_{$filter['mapelId']}_{$filter['semester']}";
        $nilaiSession = session($key, []);

        $kelasList = $guruMengajar->pluck('kelas_nama', 'kelas_id')->map(fn($nama, $id) => (object) ['id' => $id, 'nama_kelas' => $nama])->values();

        $siswaList = collect();
        if ($filter['kelasId'] && $filter['mapelId']) {
            $siswaList = \App\Models\Siswa::where('kelas_id', $filter['kelasId'])->get()->map(function($siswa) use ($nilaiSession) {
                $nilai = $nilaiSession[$siswa->id] ?? [];
                $harian = $nilai['harian'] ?? null;
                $uts = $nilai['uts'] ?? null;
                $uas = $nilai['uas'] ?? null;
                $nilai_akhir = $nilai['nilai_akhir'] ?? null;
                $status_kkm = $nilai_akhir !== null ? ($nilai_akhir >= 75 ? 'lulus' : 'tidak_lulus') : null;

                return (object) [
                    'id' => $siswa->id,
                    'nama' => $siswa->nama,
                    'harian' => $harian,
                    'uts' => $uts,
                    'uas' => $uas,
                    'nilai_akhir' => $nilai_akhir,
                    'status_kkm' => $status_kkm,
                ];
            });
        }

        return view('guru.input-nilai', [
            'id' => $guru->id,
            'namaGuru' => $guru->nama,
            'siswaList' => $siswaList,
            'guruMengajar' => $guruMengajar,
            'kelasList' => $kelasList,
            'filter' => $filter,
        ]);
    }

    private function simpanNilai(Request $request)
    {
        $nilaiData = $request->input('nilai', []);
        $mapelId = $request->input('mapel');
        $semester = $request->input('semester');
        $guru = $this->getCurrentGuru();

        if (!$mapelId || !$semester || !$guru) return;

        $kelasIds = KelasMapel::where('guru_id', $guru->id)
            ->whereNotNull('guru_id')
            ->pluck('kelas_id');

        if ($kelasIds->isEmpty()) return;

        $validSiswaIds = \App\Models\Siswa::whereIn('kelas_id', $kelasIds)->pluck('id')->toArray();

        $key = "nilai_{$guru->id}_{$mapelId}_{$semester}";
        $nilaiSession = session($key, []);

        foreach ($nilaiData as $type => $siswaNilai) {
            foreach ($siswaNilai as $siswaId => $value) {
                if ($value === '' || $value === null) continue;
                if (!in_array((int) $siswaId, $validSiswaIds)) continue;

                if (!isset($nilaiSession[$siswaId])) {
                    $nilaiSession[$siswaId] = ['harian' => null, 'uts' => null, 'uas' => null, 'nilai_akhir' => null];
                }
                $nilaiSession[$siswaId][$type] = floatval($value);

                $harian = $nilaiSession[$siswaId]['harian'] ?? 0;
                $uts = $nilaiSession[$siswaId]['uts'] ?? 0;
                $uas = $nilaiSession[$siswaId]['uas'] ?? 0;

                if ($harian && $uts && $uas) {
                    $nilaiSession[$siswaId]['nilai_akhir'] = round(($harian * 0.4) + ($uts * 0.3) + ($uas * 0.3), 1);
                }

                $nilai_akhir = $nilaiSession[$siswaId]['nilai_akhir'] ?: null;

                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswaId,
                        'mapel_id' => $mapelId,
                        'semester' => $semester,
                    ],
                    [
                        'guru_id' => $guru->id,
                        'harian' => $nilaiSession[$siswaId]['harian'] ?: null,
                        'uts' => $nilaiSession[$siswaId]['uts'] ?: null,
                        'uas' => $nilaiSession[$siswaId]['uas'] ?: null,
                        'nilai_akhir' => $nilai_akhir,
                    ]
                );
            }
        }

        session([$key => $nilaiSession]);
    }

    public function hasilbelajar($id = null, $namaGuru = null)
    {
        return redirect()->route('guru.dashboard', ['id' => $id, 'namaGuru' => $namaGuru])
                        ->with('info', 'Halaman hasil belajar belum tersedia.');
    }

    public function daftarRapor()
    {
        $guru = $this->getCurrentGuru();
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Guru tidak ditemukan.');
        }

        $guruMengajar = $this->getGuruMengajar($guru->id);
        $kelasIds = $guruMengajar->pluck('kelas_id')->unique();

        $siswaList = collect();
        if ($kelasIds->isNotEmpty()) {
            $siswaList = \App\Models\Siswa::with('kelas')
                ->whereIn('kelas_id', $kelasIds)
                ->get()
                ->map(function($s) {
                    return (object) [
                        'id' => $s->id,
                        'nis' => $s->nis,
                        'nama' => $s->nama,
                        'jenis_kelamin' => $s->jenis_kelamin,
                        'kelas_nama' => $s->kelas ? $s->kelas->nama_kelas : '-',
                    ];
                });
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
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Guru tidak ditemukan.');
        }

        $guruMengajar = $this->getGuruMengajar($guru->id);
        $kelasIds = $guruMengajar->pluck('kelas_id')->unique();

        $siswa = \App\Models\Siswa::with('kelas')
            ->where('id', $siswaId)
            ->whereIn('kelas_id', $kelasIds)
            ->first();

        if (!$siswa) {
            return redirect()->route('guru.rapor')->with('error', 'Siswa tidak ditemukan.');
        }

        $semester = request('semester', '1');
        $mapelIds = $guruMengajar->pluck('mapel_id')->unique();

        $nilaiList = \App\Models\Nilai::with('mapel')
            ->where('siswa_id', $siswaId)
            ->whereIn('mapel_id', $mapelIds)
            ->where('semester', $semester)
            ->get()
            ->map(function($n) {
                $kkm = $n->mapel->kkm ?? 75;
                $status = $n->nilai_akhir !== null
                    ? ($n->nilai_akhir >= $kkm ? 'Lulus' : 'Tidak Lulus')
                    : '-';
                return (object) [
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

        return view('guru.rapor_lihat', [
            'id' => $guru->id,
            'namaGuru' => $guru->nama,
            'siswa' => (object) [
                'id' => $siswa->id,
                'nis' => $siswa->nis,
                'nama' => $siswa->nama,
                'jenis_kelamin' => $siswa->jenis_kelamin,
                'tahun_ajaran' => $siswa->tahun_ajaran ?? '-',
                'kelas_nama' => $siswa->kelas ? $siswa->kelas->nama_kelas : '-',
                'izin' => $siswa->izin ?? 0,
                'sakit' => $siswa->sakit ?? 0,
                'alpha' => $siswa->alpha ?? 0,
            ],
            'nilaiList' => $nilaiList,
            'rata_rata' => $rata_rata,
            'semester' => $semester,
            'semesterList' => ['1' => 'Ganjil', '2' => 'Genap'],
        ]);
    }
}