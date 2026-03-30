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
        $schedule->call(function () {
            Log::info('Scheduler is running at ' . now());
        })->everyMinute();
        // Send reminders for unread contact messages every hour
        // $schedule->command('contact-messages:send-reminders')->hourly();
        $schedule->command('inspire')->everyFiveSeconds();
        $schedule->command('contact-messages:send-reminders')
                ->everyFiveSeconds()
                ->appendOutputTo(storage_path('logs/scheduler.log'));
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
