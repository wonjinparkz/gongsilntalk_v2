<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('transactions_region_update', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('아파트 거래 타입 - 0: 매매, 1: 전월세');
            $table->string('lawd_cd')->comment('법정동코드');
            $table->string('leagal_code')->comment('법정동코드');
            $table->string('region_name')->comment('시도_시군구 이름');
            $table->string('last_updated_at')->nullable()->comment('마지막 업데이트 날짜 - 높은 날짜로 기록함');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE transactions_region_update COMMENT='법정동코드'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('transactions_region_update');
    }
};
