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
        Schema::create('corp_product_price', function (Blueprint $table) {
            $table->id()->comment('매물 가격정보 아이디');
            $table->bigInteger('corp_product_id')->comment('기업 매물 아이디');
            $table->integer('payment_type')->comment('거래 방식 - 0: 매매, 3: 전세, 4: 월세');
            $table->integer('price')->comment('매매 - 매매가, 전세 - 전세가, 전매 - 전매가, 월세&단기임대&임대 - 보증금');
            $table->integer('month_price')->nullable()->comment('월 임대료');
            $table->integer('premium_price')->nullable()->comment('상가 - 권리금, 분양권 - 프리미엄 금액');
            $table->double('acquisition_tax', 10,2)->nullable()->comment('취득세율 소수점 2자리까지');
            $table->integer('support_price')->nullable()->comment('지원금액');
            $table->integer('etc_price')->nullable()->comment('기타 비용');
            $table->integer('loan_rate_one')->comment('대출 가능률');
            $table->integer('loan_rate_two')->comment('대출 가능률');
            $table->double('loan_interest', 10, 2)->nullable()->comment('대출 금리 소수점 2자리까지');
            $table->integer('is_invest')->comment('실입주/투자여부 - 0: 실입주, 1: 투자');
            $table->integer('invest_price')->nullable()->comment('투자 보증금');
            $table->integer('invest_month_price')->nullable()->comment('투자 월임대료');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE corp_product_price COMMENT='기업 이전 제안서 매물 가격'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corp_product_price');
    }
};
