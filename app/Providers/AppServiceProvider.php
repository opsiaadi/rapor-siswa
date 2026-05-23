<?php

namespace App\Providers;

use App\Interfaces\GradeProcessor;
use App\Services\GradeCalculationService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GradeProcessor::class, GradeCalculationService::class);
    }

    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $key = $request->input('role', '') . '|' . $request->input('nik', $request->ip());

            return Limit::perMinute(5)->by($key);
        });
    }
}