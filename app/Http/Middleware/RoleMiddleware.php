<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        if (in_array($user->role->value, $roles, true)) {
            return $next($request);
        }

        if (in_array('walikelas', $roles, true)
            && $user->role->value === 'guru'
            && $user->waliKelas()->exists()) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
