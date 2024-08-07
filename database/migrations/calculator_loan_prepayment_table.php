<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 대출이자 계산기 > 중도상환 내역 테이블
        Schema::create('calculator_loan_prepayment', function (Blueprint $table) {
            $table->id()->comment('중도 상환 아이디');
            $table->integer('calculator_loan_id')->comment('대출 이자 계산 아이디');
            $table->integer('sequence')->nullable()->comment('회차');
            $table->bigInteger('pay_price')->nullable()->comment('상환 금액');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculator_loan_prepayment');
    }
};
