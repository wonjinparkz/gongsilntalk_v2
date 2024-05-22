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
        Schema::create('site_proudct_primum', function (Blueprint $table) {

            $table->id()->comment('분양현장 프리미엄 아이디');
            $table->integer('site_product_id')->comment('분양현장 매물 아이디');
            $table->string('title_1')->comment("프리미엄 1 제목");
            $table->string('title_2')->comment("프리미엄 2 제목");
            $table->string('title_3')->comment("프리미엄 3 제목");
            $table->string('title_4')->comment("프리미엄 4 제목");
            $table->string('title_5')->comment("프리미엄 5 제목");
            $table->string('title_6')->comment("프리미엄 6 제목");
            $table->longText('contents_1')->nullable()->comment('프리미엄 1 내용');
            $table->longText('contents_2')->nullable()->comment('프리미엄 2 내용');
            $table->longText('contents_3')->nullable()->comment('프리미엄 3 내용');
            $table->longText('contents_4')->nullable()->comment('프리미엄 4 내용');
            $table->longText('contents_5')->nullable()->comment('프리미엄 5 내용');
            $table->longText('contents_6')->nullable()->comment('프리미엄 6 내용');
            $table->string('is_blind_1')->comment("프리미엄 3,4 노출여부 - 0: 노출, 1: 노출 안함");
            $table->string('is_blind_2')->comment("프리미엄 5,6 노출여부 - 0: 노출, 1: 노출 안함");
            $table->timestamps();
        });
        DB::statement("ALTER TABLE site_proudct_primum COMMENT='분양현장 프리미엄'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_proudct_primum');
    }
};
