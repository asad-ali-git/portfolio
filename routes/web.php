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

Route::get('/fix-permissions', function () {
    $commands = [
        'chmod -R 775 ' . escapeshellarg(storage_path()),
        'chmod -R 775 ' . escapeshellarg(base_path('bootstrap/cache')),
    ];

    $result = [];

    foreach ($commands as $command) {
        $output = [];
        $exitCode = 0;

        exec($command . ' 2>&1', $output, $exitCode);

        $result[] = '$ ' . $command;
        $result[] = 'exit code: ' . $exitCode;
        $result[] = empty($output) ? '(no output)' : implode(PHP_EOL, $output);
        $result[] = str_repeat('-', 40);
    }

    return response(implode(PHP_EOL, $result), 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
});

Route::view('/{any}', 'app')
    ->where('any', '^(?!(api|admin|filament|clear|schedule-list|schedule-run|fix-permissions)$).*$');

