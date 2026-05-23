<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureGuru
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('guru')->check()) {
            abort(403, 'Akses ditolak.');
        }

        if (session('role') !== 'walikelas') {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk Wali Kelas.');
        }

        return $next($request);
    }
}
