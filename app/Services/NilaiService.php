<?php

namespace App\Services;

use App\Enums\Semester;
use App\Models\KelasMapel;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as BaseCollection;

class NilaiService
{
    public function __construct(
        private NilaiMapperService $nilaiMapperService,
    ) {}

    public function getGuruMengajar(int $guruId): BaseCollection
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

    public function resolveFilter(Request $request, BaseCollection $guruMengajar): array
    {
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

        return $filter;
    }

    public function getKelasDropdownList(BaseCollection $guruMengajar): BaseCollection
    {
        return $guruMengajar->pluck('kelas_nama', 'kelas_id')
            ->map(fn($nama, $id) => (object) ['id' => $id, 'nama_kelas' => $nama])
            ->values();
    }

    public function saveNilaiBatch(array $nilaiData, int $mapelId, string $semester, object $user): void
    {
        foreach ($nilaiData['harian'] ?? [] as $siswaId => $value) {
            $harian = isset($nilaiData['harian'][$siswaId]) && $nilaiData['harian'][$siswaId] !== '' ? floatval($nilaiData['harian'][$siswaId]) : null;
            $uts = isset($nilaiData['uts'][$siswaId]) && $nilaiData['uts'][$siswaId] !== '' ? floatval($nilaiData['uts'][$siswaId]) : null;
            $uas = isset($nilaiData['uas'][$siswaId]) && $nilaiData['uas'][$siswaId] !== '' ? floatval($nilaiData['uas'][$siswaId]) : null;

            $nilai_akhir = null;
            $component = [];

            if ($harian !== null) $component[] = $harian * 0.4;
            if ($uts !== null) $component[] = $uts * 0.3;
            if ($uas !== null) $component[] = $uas * 0.3;

            if (!empty($component)) {
                $nilai_akhir = round(array_sum($component), 1);
            }

            Nilai::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'mapel_id' => $mapelId,
                    'semester' => $semester,
                ],
                [
                    'guru_id' => $user->id,
                    'harian' => $harian,
                    'uts' => $uts,
                    'uas' => $uas,
                    'nilai_akhir' => $nilai_akhir,
                ]
            );
        }
    }

    public function getSiswaNilaiForEdit(?string $kelasId, ?string $mapelId, string $semester): BaseCollection
    {
        if (!$kelasId || !$mapelId) return collect();

        $mapel = Mapel::find($mapelId);
        $kkm = $mapel?->kkm ?? 75;

        $nilai = Nilai::where('mapel_id', $mapelId)
            ->where('semester', $semester)
            ->get()
            ->keyBy('siswa_id');

        return Siswa::findByKelasId((int) $kelasId)->map(function($siswa) use ($nilai, $kkm) {
            $n = $nilai->get($siswa->id);
            $nilai_akhir = $n?->nilai_akhir ?? null;
            return (object) [
                'id' => $siswa->id,
                'nama' => $siswa->nama,
                'harian' => $n?->harian ?? null,
                'uts' => $n?->uts ?? null,
                'uas' => $n?->uas ?? null,
                'nilai_akhir' => $nilai_akhir,
                'nilai_id' => $n?->id ?? null,
                'status_kkm' => $nilai_akhir !== null
                    ? ($nilai_akhir >= $kkm ? 'lulus' : 'tidak_lulus')
                    : null,
            ];
        });
    }

    public function findMengajarId(int $kelasId, int $mapelId, int $guruId): ?int
    {
        return KelasMapel::where('kelas_id', $kelasId)
            ->where('mapel_id', $mapelId)
            ->where('guru_id', $guruId)
            ->first()?->id;
    }

    public function getRaporSiswaList(int $guruId): BaseCollection
    {
        $guruMengajar = $this->getGuruMengajar($guruId);
        $kelasIds = $guruMengajar->pluck('kelas_id')->unique();

        if ($kelasIds->isEmpty()) return collect();

        return Siswa::findWithKelasByKelasIds($kelasIds->toArray())
            ->map(fn($s) => Siswa::toDaftar($s));
    }

    public function getRaporData(int $siswaId, int $guruId, string $semester): ?array
    {
        $guruMengajar = $this->getGuruMengajar($guruId);
        $kelasIds = $guruMengajar->pluck('kelas_id')->unique();
        $siswa = Siswa::findByIdInKelasIds($siswaId, $kelasIds->toArray());

        if (!$siswa) return null;

        $mapelIds = $guruMengajar->pluck('mapel_id')->unique();
        $nilaiModels = Nilai::findBySiswaMapelSemester($siswaId, $mapelIds->toArray(), $semester);
        $nilaiList = $this->nilaiMapperService->mapNilaiList($nilaiModels);
        $rata_rata = $this->nilaiMapperService->calculateRataRata($nilaiList);

        return [
            'siswa' => Siswa::toRaporDetail($siswa),
            'nilaiList' => $nilaiList,
            'rata_rata' => $rata_rata,
            'semester' => $semester,
            'semesterList' => Semester::labels(),
        ];
    }

    public static function nilaiFieldRules(): array
    {
        return [
            'nilai' => 'nullable|array',
            'nilai.harian.*' => 'nullable|numeric|min:0|max:100',
            'nilai.uts.*' => 'nullable|numeric|min:0|max:100',
            'nilai.uas.*' => 'nullable|numeric|min:0|max:100',
        ];
    }
}
