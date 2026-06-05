<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

abstract class Controller
{ 
    protected function getCurrentUser(): ?User
    {
        return auth:user();
    }
}