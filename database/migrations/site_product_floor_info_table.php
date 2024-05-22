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
        Schema::create('site_product_floor_info', function (Blueprint $table) {

            $table->id()->comment('분양현장 매물 층별 정보 아이디');
            $table->integer('site_product_dong_id')->comment('분양현장 매물 동별 아이디');
            $table->string('floor_name')->comment('층 이름');
            $table->integer('is_neighborhood_life')->comment('근생지원시설 - 0: 선택안함, 1 - 선택함');
            $table->integer('is_industry_center')->comment('지식산업센터 - 0: 선택안함, 1 - 선택함');
            $table->integer('is_warehouse')->comment('공동창고 - 0: 선택안함, 1 - 선택함');
            $table->integer('is_dormitory')->comment('기숙사,유치원 - 0: 선택안함, 1 - 선택함');
            $table->integer('is_business_support')->comment('업무지원시설 - 0: 선택안함, 1 - 선택함');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE site_product_floor_info COMMENT='분양현장 매물 층별 정보 아이디'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_product_floor_info');
    }
};
