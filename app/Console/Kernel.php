<?php

namespace App\Console;

use App\Http\Controllers\data\DataController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
            // 명시적으로 환경 변수를 설정합니다.
            config(['database.connections.mysql.host' => env('DB_HOST', '127.0.0.1')]);
            config(['database.connections.mysql.database' => env('DB_DATABASE', 'your_database')]);
            config(['database.connections.mysql.username' => env('DB_USERNAME', 'your_username')]);
            config(['database.connections.mysql.password' => env('DB_PASSWORD', 'your_password')]);

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
