<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// File konten sah (gambar/PDF/video) dibiarkan. Hanya file berbahaya atau
// berindikasi judol yang dipindahkan ke karantina untuk ditinjau admin.
Schedule::command('website:integrity-scan --quarantine')
    ->hourly()
    ->appendOutputTo(storage_path('logs/integrity-scanner.log'));

Schedule::command('website:repair-integrity')
    ->hourly()
    ->appendOutputTo(storage_path('logs/integrity-repair.log'));
