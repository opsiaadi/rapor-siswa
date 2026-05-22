<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{
    protected $table = 'guru';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function mapels(): BelongsToMany
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel', 'guru_id', 'mapel_id');
    }

    public function mapelsDirect(): BelongsToMany
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel', 'guru_id', 'mapel_id');
    }

    public function kelasDiampu(): HasMany
    {
        return $this->hasMany(KelasMapel::class);
    }

    public function waliKelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }
}
