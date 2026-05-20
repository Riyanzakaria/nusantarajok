<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| AUTO-STITCH OS — Scheduled Tasks
|--------------------------------------------------------------------------
| leads:prune — Hapus leads basi (raw/dropped) yang berumur > 30 hari.
| Dijalankan otomatis setiap Minggu dini hari (weekly).
| Untuk menjalankan manual: php artisan leads:prune
| Untuk menjalankan di production: tambahkan cron berikut ke server:
|   * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
|
*/
Schedule::command('leads:prune --days=30')
    ->weekly()
    ->sundays()
    ->at('02:00')
    ->withoutOverlapping()
    ->runInBackground();
