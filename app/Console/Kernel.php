<?php

namespace App\Console;

use App\Http\Controllers\data\DataController;
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
        // $schedule->command('app:get-building-ledger')->everyMinute();
        // $schedule->command('app:send-siteProduct-alarm')->dailyAt('00:00');


        $schedule->call(function () {
            Log::info('Scheduler is running.');
            // 여기에서 실제 스케줄 작업을 수행합니다.
            DB::table('data_apt')->where('is_base_info', 0)->limit(1)->get();
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
