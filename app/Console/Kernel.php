<?php

namespace App\Console;

use App\Http\Controllers\data\DataController;
use App\Models\DataApt;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:get-apt-info')->everyMinute();
        // $schedule->command('app:send-siteProduct-alarm')->dailyAt('00:00');
        // $schedule->command('app:get-building-ledger')->everyMinute();


        // $schedule->call(function () {
        //     Log::info('Scheduler is running.');
        //     User::whereDate('id', 6)
        //         ->update([
        //             "type" => 1
        //         ]);
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
