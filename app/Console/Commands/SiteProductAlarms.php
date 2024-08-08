<?php

namespace App\Console\Commands;

use App\Http\Controllers\commons\SiteProductAlarmPcController;
use Illuminate\Console\Command;

class SiteProductAlarms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-siteProduct-alarm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '분양현장 알림 보내기';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $siteAlarm = new SiteProductAlarmPcController;
        $siteAlarm->sendSiteProductAlramDday(); // 당일
        $siteAlarm->sendSiteProductAlramOneday(); // 하루전
        $siteAlarm->sendSiteProductAlramWeek(); // 일주일 전

        $this->info('분양현장 알림을 보냈습니다.');
    }
}
