<?php

namespace App\Console;

use App\Http\Controllers\data\DataController;
use App\Models\DataApt;
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
        // $schedule->command('app:get-apt-info')->everyMinute();
        // $schedule->command('app:send-siteProduct-alarm')->dailyAt('00:00');
        // $schedule->command('app:get-building-ledger')->everyMinute();


        $schedule->call(function () {
            Log::info('Scheduler is running.');
            $DetailInfo = DataApt::where('is_detail_info', 0)->first();
            Log::info($DetailInfo);
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
