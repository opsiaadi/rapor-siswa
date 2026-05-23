<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelasMapel extends Model
{
    protected $table = 'kelas_mapel';

    protected $fillable = [
        'kelas_id',
        'mapel_id',
        'guru_id',
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }

    public static function findByGuruId(int $guruId): Collection
    {
        return static::with(['mapel', 'kelas'])
            ->where('guru_id', $guruId)
            ->whereNotNull('guru_id')
            ->get();
    }

    public static function pluckKelasIdsByGuruId(int $guruId): array
    {
        return static::where('guru_id', $guruId)
            ->whereNotNull('guru_id')
            ->pluck('kelas_id')
            ->toArray();
    }
}
