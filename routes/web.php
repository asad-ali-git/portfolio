<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::view('/', 'app');

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return 'Cleared';
});

Route::view('/{any}', 'app')
    ->where('any', '^(?!(api|admin|filament|clear)$).*$');

