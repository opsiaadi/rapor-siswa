<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'wali_kelas_id',
    ];

    public function waliKelas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }

    public function mapels(): BelongsToMany
    {
        return $this->belongsToMany(Mapel::class, 'kelas_mapel', 'kelas_id', 'mapel_id')
            ->withPivot('guru_id')
            ->withTimestamps();
    }

    public function kelasMapels(): HasMany
    {
        return $this->hasMany(KelasMapel::class);
    }

    public static function findByWaliKelasId(int $guruId): Collection
    {
        return static::where('wali_kelas_id', $guruId)->get();
    }
}
