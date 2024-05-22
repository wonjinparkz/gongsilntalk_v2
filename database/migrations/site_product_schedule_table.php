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
        Schema::create('site_product_schedule', function (Blueprint $table) {

            $table->id()->comment('분양현장 매물 분양 일정 아이디');
            $table->integer('site_product_id')->comment('분양현장 매물 아이디');
            $table->string('title')->comment("일정 정보 제목");
            $table->date('start_date')->comment("일정 시작일");
            $table->date('ended_date')->comment("일정 종료일");
            $table->timestamps();
        });
        DB::statement("ALTER TABLE site_product_schedule COMMENT='분양현장 매물 분양 일정'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_product_schedule');
    }
};
