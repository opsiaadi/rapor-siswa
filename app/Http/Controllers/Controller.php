<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function getCurrentGuru(): ?Guru
    {
        if (Auth::guard('guru')->check()) {
            return Auth::guard('guru')->user();
        }
        return null;
    }

    protected function getCurrentAdmin(): ?Admin
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->user();
        }
        return null;
    }
}
