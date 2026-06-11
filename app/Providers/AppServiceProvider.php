<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Memaksa skema HTTPS jika aplikasi berjalan di Railway atau di balik proxy HTTPS.
        $https = false;

        if (config('app.env') === 'production') {
            $https = true;
        }

        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            $https = true;
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && str_contains(strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']), 'https')) {
            $https = true;
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && strtolower($_SERVER['HTTP_X_FORWARDED_SSL']) === 'on') {
            $https = true;
        }

        if ($https) {
            URL::forceScheme('https');
        }
    }
}
