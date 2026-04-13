<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Model
{
    use HasFactory;

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

    public function mapel(): BelongsToMany
    {
        return $this->belongsToMany(Mapel::class, 'kelas_mapel', 'guru_id', 'mapel_id');
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
