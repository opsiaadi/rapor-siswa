<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(\App\Http\Middleware\SecurityHeadersMiddleware::class);
        $middleware->alias([
            'walikelas' => \App\Http\Middleware\EnsureWalikelas::class,
            'admin.active' => \App\Http\Middleware\EnsureAdminActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (HttpException $e) {
            if ($e->getStatusCode() === 419) {
                return redirect('/login')->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
            }
        });
    })->create();
