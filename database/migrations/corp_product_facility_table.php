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
        Schema::create('corp_product_facility', function (Blueprint $table) {
            $table->id()->comment('시설정보');
            $table->bigInteger('corp_product_id')->comment('기업 매물 아이디');
            $table->integer('type')->comment('타입 - 0: 드라이브인, 1: 업무용, 2: 인테리어, 3: 테라스, 4: 베란다, 5: 화물용승강기, 6: 하역장, 7: 화장실, 8: 샤워장, 9: 싱크대, 10: 냉장고, 11: 세탁기');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE corp_product_facility COMMENT='기업 이전 제안서'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corp_product_facility');
    }
};
