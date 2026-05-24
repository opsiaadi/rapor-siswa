<?php

namespace App\Services;

use App\Interfaces\GradeProcessor;
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

}
