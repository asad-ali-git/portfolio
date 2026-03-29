<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
    Log::info('Inspiring quote displayed: ' . Inspiring::quote());
})->purpose('Display an inspiring quote');
