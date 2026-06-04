<?php

namespace App\Models;

<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> 3793cdf1173aefa19ab18512509b445ead3e0bed
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 7e26a6e78dec355319f45492333b56002a784e7f
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
<<<<<<< HEAD
<<<<<<< HEAD
    use HasFactory, Notifiable;
=======
    use Notifiable;
>>>>>>> 3793cdf1173aefa19ab18512509b445ead3e0bed
=======
    use HasFactory, Notifiable;
>>>>>>> 7e26a6e78dec355319f45492333b56002a784e7f

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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
