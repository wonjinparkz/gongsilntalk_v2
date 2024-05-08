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
        Schema::create('product_price', function (Blueprint $table) {
            $table->id()->comment('매물 가격정보 아이디');
            $table->integer('product_id')->nullable()->comment('매물 아이디');
            $table->integer('payment_type')->nullable()->comment('거래 방식 - 0: 매매, 1: 임대, 2: 단기임대, 3: 전세, 4: 월세, 5: 전매');
            $table->integer('price')->nullable()->comment('매매 - 매매가, 전세 - 전세가, 전매 - 전매가, 월세&단기임대&임대 - 보증금');
            $table->integer('month_price')->nullable()->comment('월세 - 월세, 단기임대&임대 -월임대료');
            $table->integer('is_price_discussion')->nullable()->comment('거래 가격 협의 가능 여부 - 0: 협의 안함, 1: 협의 가능');
            $table->integer('is_use')->nullable()->comment('현재 매물 사용 여부 - 0: 없음, 1: 있음');
            $table->integer('current_price')->nullable()->comment('현재 매물 보증금');
            $table->integer('current_month_price')->nullable()->comment('현재 매물 월임대료');
            $table->integer('is_premium')->nullable()->comment('권리금 여부 - 0: 없음, 1: 있음');
            $table->integer('premium_price')->nullable()->comment('상가 - 권리금, 분양권 - 프리미엄 금액');

            // Indexes
            $table->timestamps();
        });
        DB::statement("ALTER TABLE product_price COMMENT='매물 가격정보'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_price');
    }
};
