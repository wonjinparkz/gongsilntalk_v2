<?php

namespace App\Console;

use App\Http\Controllers\data\DataController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:get-apt-info')->everyMinute();
        $schedule->command('app:get-building-ledger')->everyMinute();
        $schedule->command('app:send-siteProduct-alarm')->dailyAt('00:00');

        // $schedule->call(function () {
        // })->everyMinute();
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
