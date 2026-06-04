<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nik',
        'name',
        'nama',
        'email',
        'password',
        'role',
        'status',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function mapels(): BelongsToMany
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel', 'guru_id', 'mapel_id');
    }

    public function kelasDiampu(): HasMany
    {
        return $this->hasMany(KelasMapel::class, 'guru_id');
    }

    public function waliKelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }
}
