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
    $targets = [
        storage_path(),
        base_path('bootstrap/cache'),
    ];

    $mode = 0775;
    $result = [];

    foreach ($targets as $target) {
        $processed = 0;
        $failed = 0;

        if (!is_dir($target)) {
            $result[] = 'Target not found: ' . $target;
            $result[] = str_repeat('-', 40);
            continue;
        }

        $items = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($target, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        if (!chmod($target, $mode)) {
            $failed++;
        }
        $processed++;

        foreach ($items as $item) {
            if (!chmod($item->getPathname(), $mode)) {
                $failed++;
            }
            $processed++;
        }

        $result[] = 'Target: ' . $target;
        $result[] = 'Mode: 0775';
        $result[] = 'Processed: ' . $processed;
        $result[] = 'Failed: ' . $failed;
        $result[] = $failed === 0 ? 'Status: OK' : 'Status: Completed with errors';
        $result[] = str_repeat('-', 40);
    }

    return response(implode(PHP_EOL, $result), 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
});

Route::view('/{any}', 'app')
    ->where('any', '^(?!(api|admin|filament|clear|schedule-list|schedule-run|fix-permissions)$).*$');

Route::get('/artisan/{command}', function ($secret, $command) {

    $allowed = [
        'optimize:clear',
        'config:clear',
        'cache:clear',
        'route:clear',
        'view:clear',
        'queue:restart',
        'migrate',
        'storage:link',
    ];

    if (!in_array($command, $allowed)) {
        return response()->json(['error' => 'Command not allowed.'], 403);
    }

    Artisan::call($command);

    return response()->json([
        'status'  => 'success',
        'command' => $command,
        'output'  => Artisan::output(),
        'time'    => now()->toDateTimeString(),
    ]);
});
