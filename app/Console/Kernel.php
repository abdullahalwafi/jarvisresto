<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:daily-open-resto')
        ->weekdays()
        ->timezone("Asia/Jakarta")
        ->at("9:00");

        $schedule->command('app:daily-close-resto')
        ->weekdays()
        ->timezone("Asia/Jakarta")
        ->at("21:00");

        $schedule->command('app:daily-open-resto')
        ->saturdays()
        ->timezone("Asia/Jakarta")
        ->at("9:00");

        $schedule->command('app:daily-close-resto')
        ->saturdays()
        ->timezone("Asia/Jakarta")
        ->at("21:00");

        $schedule->command('app:daily-open-resto')
        ->mondays()
        ->timezone("Asia/Jakarta")
        ->at("10:00");

        $schedule->command('app:daily-close-resto')
        ->mondays()
        ->timezone("Asia/Jakarta")
        ->at("20:00");
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
