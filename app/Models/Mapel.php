<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';

    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
        'kkm',
    ];

    public function kelas(): BelongsToMany
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mapel', 'mapel_id', 'kelas_id')
            ->withPivot('guru_id')
            ->withTimestamps();
    }

    public function guru(): BelongsToMany
    {
        return $this->belongsToMany(Guru::class, 'kelas_mapel', 'mapel_id', 'guru_id');
    }

    public function kelasMapel(): HasMany
    {
        return $this->hasMany(KelasMapel::class);
    }
}
