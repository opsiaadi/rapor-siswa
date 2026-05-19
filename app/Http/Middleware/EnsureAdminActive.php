<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin || $admin->status !== 'aktif') {
            abort(403, 'Akun admin tidak aktif.');
        }

        return $next($request);
    }
}