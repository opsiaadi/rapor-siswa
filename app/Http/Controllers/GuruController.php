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

        $key = "nilai_{$guru->id}_{$mapelId}_{$semester}";
        $nilaiSession = session($key, []);

        foreach ($nilaiData as $type => $siswaNilai) {
            foreach ($siswaNilai as $siswaId => $value) {
                if ($value === '' || $value === null) continue;

                if (!isset($nilaiSession[$siswaId])) {
                    $nilaiSession[$siswaId] = ['harian' => '', 'uts' => '', 'uas' => '', 'nilai_akhir' => ''];
                }
                $nilaiSession[$siswaId][$type] = floatval($value);

                $harian = $nilaiSession[$siswaId]['harian'] ?? 0;
                $uts = $nilaiSession[$siswaId]['uts'] ?? 0;
                $uas = $nilaiSession[$siswaId]['uas'] ?? 0;

                if ($harian && $uts && $uas) {
                    $nilaiSession[$siswaId]['nilai_akhir'] = round(($harian * 0.4) + ($uts * 0.3) + ($uas * 0.3), 1);
                }

                $nilai_akhir = $nilaiSession[$siswaId]['nilai_akhir'] ?? null;

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
}