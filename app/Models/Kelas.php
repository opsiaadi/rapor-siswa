<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'wali_kelas_id',
    ];

    public function waliKelas(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }

    public function mapel(): BelongsToMany
    {
        return $this->belongsToMany(Mapel::class, 'kelas_mapel', 'kelas_id', 'mapel_id')
            ->withPivot('guru_id')
            ->withTimestamps();
    }

    public function kelasMapel(): HasMany
    {
        return $this->hasMany(KelasMapel::class);
    }
}
