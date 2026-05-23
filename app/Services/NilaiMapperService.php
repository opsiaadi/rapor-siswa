<?php

namespace App\Services;

use App\Interfaces\GradeProcessor;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\KelasMapel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

class NilaiMapperService
{
    public function __construct(
        private GradeProcessor $gradeProcessor
    ) {}

    public function mapNilaiList(Collection $nilaiList): BaseCollection
    {
        return $nilaiList->map(function ($n) {
            $kkm = $n->mapel->kkm ?? 75;
            $status = $n->nilai_akhir !== null
                ? ($this->gradeProcessor->isPassedKKM($n->nilai_akhir, $kkm) ? 'Lulus' : 'Tidak Lulus')
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
    }

    public function calculateRataRata(BaseCollection $nilaiList): float|string
    {
        $nilaiAkhirValues = $nilaiList
            ->where('nilai_akhir', '!=', '-')
            ->pluck('nilai_akhir')
            ->toArray();

        return $this->gradeProcessor->calculateAverage($nilaiAkhirValues);
    }

    public function saveNilaiFromRequest(array $nilaiData, int $mapelId, string $semester, object $guru, array $currentSession): array
    {
        $kelasIds = KelasMapel::pluckKelasIdsByGuruId($guru->id);
        if (empty($kelasIds)) return $currentSession;

        $validSiswaIds = Siswa::pluckIdsByKelasIds($kelasIds);
        $nilaiSession = $currentSession;

        foreach ($nilaiData as $type => $siswaNilai) {
            foreach ($siswaNilai as $siswaId => $value) {
                if ($value === '' || $value === null) continue;
                if (!in_array((int) $siswaId, $validSiswaIds)) continue;

                if (!isset($nilaiSession[$siswaId])) {
                    $nilaiSession[$siswaId] = ['harian' => null, 'uts' => null, 'uas' => null, 'nilai_akhir' => null];
                }
                $nilaiSession[$siswaId][$type] = floatval($value);

                $harian = $nilaiSession[$siswaId]['harian'] ?? null;
                $uts = $nilaiSession[$siswaId]['uts'] ?? null;
                $uas = $nilaiSession[$siswaId]['uas'] ?? null;

                if ($harian !== null && $uts !== null && $uas !== null) {
                    $nilaiSession[$siswaId]['nilai_akhir'] = $this->gradeProcessor->calculateFinalGrade($harian, $uts, $uas);
                }

                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswaId,
                        'mapel_id' => $mapelId,
                        'semester' => $semester,
                    ],
                    [
                        'guru_id' => $guru->id,
                        'harian' => $nilaiSession[$siswaId]['harian'] ?? null,
                        'uts' => $nilaiSession[$siswaId]['uts'] ?? null,
                        'uas' => $nilaiSession[$siswaId]['uas'] ?? null,
                        'nilai_akhir' => $nilaiSession[$siswaId]['nilai_akhir'] ?? null,
                    ]
                );
            }
        }

        return $nilaiSession;
    }

    public function buildSiswaNilaiList(?string $kelasId, ?string $mapelId, object $guru, array $filter): BaseCollection
    {
        if (!$kelasId || !$mapelId) return collect();

        $key = "nilai_{$guru->id}_{$filter['mapelId']}_{$filter['semester']}";
        $nilaiSession = session($key, []);

        return Siswa::findByKelasId((int) $kelasId)->map(function($siswa) use ($nilaiSession) {
            $nilai = $nilaiSession[$siswa->id] ?? [];
            $nilai_akhir = $nilai['nilai_akhir'] ?? null;
            return (object) [
                'id' => $siswa->id,
                'nama' => $siswa->nama,
                'harian' => $nilai['harian'] ?? null,
                'uts' => $nilai['uts'] ?? null,
                'uas' => $nilai['uas'] ?? null,
                'nilai_akhir' => $nilai_akhir,
                'status_kkm' => $nilai_akhir !== null
                    ? ($this->gradeProcessor->isPassedKKM($nilai_akhir, 75) ? 'lulus' : 'tidak_lulus')
                    : null,
            ];
        });
    }
}
