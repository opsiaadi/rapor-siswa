<?php

namespace App\Interfaces;

interface GradeProcessor
{
    public function calculateFinalGrade(float $harian, float $uts, float $uas): float;
    public function isPassedKKM(float $nilaiAkhir, int $kkm = 75): bool;
    public function calculateAverage(array $nilaiAkhirList): float|string;
}
