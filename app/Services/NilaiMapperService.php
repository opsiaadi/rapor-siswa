<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

class NilaiMapperService
{
    public function mapNilaiList(Collection $nilaiList): BaseCollection
    {
        return $nilaiList->map(function ($n) {
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
    }

    public function mapNilaiListByMapel(BaseCollection $mapels, Collection $nilaiList): BaseCollection
    {
        $nilaiByMapel = $nilaiList->keyBy('mapel_id');

        return $mapels->map(function ($mapel) use ($nilaiByMapel) {
            $n = $nilaiByMapel->get($mapel->id);
            $kkm = $mapel->kkm ?? 75;
            $nilaiAkhir = $n?->nilai_akhir;
            $status = $nilaiAkhir !== null
                ? ($nilaiAkhir >= $kkm ? 'Lulus' : 'Tidak Lulus')
                : '-';

            return (object) [
                'mapel_nama' => $mapel->nama_mapel ?? '-',
                'kkm' => $kkm,
                'harian' => $n?->harian ?? '-',
                'uts' => $n?->uts ?? '-',
                'uas' => $n?->uas ?? '-',
                'nilai_akhir' => $nilaiAkhir ?? '-',
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

        $valid = array_filter($nilaiAkhirValues, fn ($n) => $n !== '-' && $n !== null);
        if (empty($valid)) {
            return '-';
        }

        return round(array_sum($valid) / count($valid), 2);
    }
}
