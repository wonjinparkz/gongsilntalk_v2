<?php

namespace App\Console\Commands;

use App\Http\Controllers\data\DataController;
use Illuminate\Console\Command;

class GetBuildingLedger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-building-ledger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '표제부 정보';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dataController = new DataController;
        $dataController->getAptBuildingLedger();

        $this->info('아파트 정보를 가져오는데 성공했습니다.');
    }
}
