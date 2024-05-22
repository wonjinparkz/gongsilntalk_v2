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
        Schema::create('site_product_dong', function (Blueprint $table) {

            $table->id()->comment('분양현장 매물 동별 아이디');
            $table->integer('site_product_id')->comment('분양현장 매물 아이디');
            $table->string('dong_name')->comment("동 이름");
            $table->timestamps();
        });
        DB::statement("ALTER TABLE site_product_dong COMMENT='분양현장 매물 동별'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_product_dong');
    }
};
