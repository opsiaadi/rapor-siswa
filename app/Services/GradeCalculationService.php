<?php

namespace App\Services;

use App\Interfaces\GradeProcessor;

class GradeCalculationService implements GradeProcessor
{
    public function calculateFinalGrade(float $harian, float $uts, float $uas): float
    {
        return round(($harian * 0.4) + ($uts * 0.3) + ($uas * 0.3), 1);
    }

    public function isPassedKKM(float $nilaiAkhir, int $kkm = 75): bool
    {
        return $nilaiAkhir >= $kkm;
    }

    public function calculateAverage(array $nilaiAkhirList): float|string
    {
        $valid = array_filter($nilaiAkhirList, fn($n) => $n !== '-' && $n !== null);

        if (empty($valid)) {
            return '-';
        }

        return round(array_sum($valid) / count($valid), 2);
    }
}
