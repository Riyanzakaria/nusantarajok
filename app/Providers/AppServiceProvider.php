<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

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
        /*
        |----------------------------------------------------------------------
        | Rate Limiter: Tracker Search (Anti-Brute Force)
        |----------------------------------------------------------------------
        | Blueprint §2: "Anti-Brute Force Layer"
        | Allows 5 requests per minute per IP address.
        | The 6th request returns HTTP 429 Too Many Requests.
        |
        */
        RateLimiter::for('tracker-search', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        /*
        |----------------------------------------------------------------------
        | Rate Limiter: Lead Capture (Anti-Spam, Kalkulator Publik)
        |----------------------------------------------------------------------
        | Maksimal 3 submissions per IP setiap 60 menit.
        | Request ke-4 mengembalikan HTTP 429 Too Many Requests.
        |
        */
        RateLimiter::for('lead-capture', function (Request $request) {
            return Limit::perHour(3)->by($request->ip())->response(function () {
                return response()->json([
                    'status'  => 'throttled',
                    'message' => 'Terlalu banyak permintaan. Coba lagi dalam 60 menit.',
                ], 429);
            });
        });
    }
}

