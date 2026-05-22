<?php

namespace App\Models;

use App\Enums\RoleAdmin;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';

    protected $fillable = [
        'nama',
        'email',
        'foto',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'role' => RoleAdmin::class,
        ];
    }
}
