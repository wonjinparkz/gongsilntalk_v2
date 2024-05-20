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
        // 대출이자 계산
        Schema::create('calculator_loan', function (Blueprint $table) {
            $table->id()->comment('대출이자 계산 아이디');
            $table->integer('users_id')->comment('유저 아이디');
            $table->integer('sale_price')->nullable()->comment('매매/분양가');
            $table->double('acquisition_tax', 10, 2)->nullable()->comment('취득세율 소수점 2자리까지');
            $table->integer('tax_price')->nullable()->comment('세무비용');
            $table->integer('commission')->nullable()->comment('중개 보수 (부가세 별도)');
            $table->integer('ctc_price')->nullable()->comment('기타비용');
            $table->integer('price')->nullable()->comment('보증금');
            $table->integer('month_price')->nullable()->comment('월 임대료');
            $table->integer('loan_ratio')->nullable()->comment('대출 비율');
            $table->double('loan_interest', 10, 2)->nullable()->comment('대출 금리 소수점 2자리까지');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculator_loan');
    }
};
