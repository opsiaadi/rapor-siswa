<?php

namespace App\Models;

use App\Enums\Semester;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = [
        'siswa_id',
        'mapel_id',
        'guru_id',
        'semester',
        'harian',
        'uts',
        'uas',
        'nilai_akhir',
    ];

    protected function casts(): array
    {
        return [
            'harian' => 'float',
            'uts' => 'float',
            'uas' => 'float',
            'nilai_akhir' => 'float',
            'semester' => Semester::class,
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }

    public static function findBySiswaMapelSemester(int $siswaId, array $mapelIds, string $semester): Collection
    {
        return static::with('mapel')
            ->where('siswa_id', $siswaId)
            ->whereIn('mapel_id', $mapelIds)
            ->where('semester', $semester)
            ->get();
    }

    public static function findBySiswaSemester(int $siswaId, string $semester): Collection
    {
        return static::with(['mapel', 'guru'])
            ->where('siswa_id', $siswaId)
            ->where('semester', $semester)
            ->get();
    }

    public static function getRataRata(int $siswaId, string $semester): float|string
    {
        $avg = static::where('siswa_id', $siswaId)
            ->where('semester', $semester)
            ->avg('nilai_akhir');

        return $avg !== null ? round($avg, 1) : '-';
    }
}