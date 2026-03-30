<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::view('/', 'app');

// php artisan schedule:list

Route::get('/schedule-list', function () {
    Artisan::call('schedule:list', [
        '--no-ansi' => true,
    ]);

    return response(Artisan::output(), 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
});

Route::get('/schedule-run', function () {
    Artisan::call('schedule:run', [
        '--no-ansi' => true,
    ]);

    return response(Artisan::output(), 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
});

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return 'Cleared';
});

Route::view('/{any}', 'app')
    ->where('any', '^(?!(api|admin|filament|clear)$).*$');

