<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Use minute-based scheduling only
        $schedule->command('inspire')
            ->everyMinute()
            ->appendOutputTo(storage_path('logs/inspire.log'));

        $schedule->command('contact-messages:send-reminders')
            ->everyMinute()  // or hourly() depending on your needs
            ->appendOutputTo(storage_path('logs/contact-reminders.log'));

        // Add a heartbeat to verify scheduler is running
        $schedule->call(function () {
            Log::info('Scheduler heartbeat at ' . now());
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
