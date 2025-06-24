<?php

namespace App\Console\Commands;

use App\Http\Controllers\data\DataController;
use App\Models\Notice;
use Illuminate\Console\Command;

class GetAptInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-apt-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '아파트 정보';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $dataController = new DataController;
        // $dataController->getAptBaseInfo();
        // $dataController->getAptDetailInfo();
        // $dataController->getAptMapInfo();
        // $dataController->getAptAddrss();
        // $dataController->getAptPolygon();
        // $dataController->getAptCharacteristics();
        // $dataController->getAptuseWFS();

        // 공지사항 viewcount 증가 예시
        Notice::query()->increment('view_count');
        // 또는 특정 공지사항만 증가시키려면:
        // Notice::where('id', 1)->increment('view_count');

        $this->info('아파트 정보를 가져오는데 성공했습니다.');
    }
}
