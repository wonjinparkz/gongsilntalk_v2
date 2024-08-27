<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HandleExpiredProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:handle-expired-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '매물 등록 만료 처리';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date30DaysAgo = Carbon::now()->subDays(30)->startOfDay();

        // Assuming you have a 'expires_at' column on your 'products' table
        $expiredProducts = Product::where('user_type', 1)->where('created_at', '<', $date30DaysAgo)->first();

        info('$expiredProducts : ', $expiredProducts);
        // foreach ($expiredProducts as $product) {
            $expiredProducts->update(['status' => '4']); // Example action
        // }

        $this->info('중개사 매물 30일 초과 등록만료 처리.');
    }
}
