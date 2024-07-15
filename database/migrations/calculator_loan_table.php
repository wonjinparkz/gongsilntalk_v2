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

            $table->integer('type')->nullable()->comment('대출 구분 - 1: 원금균등분할, 2: 원리금균등분할, 3: 만기일시');

            $table->integer('loan_price')->nullable()->comment('대출 원금');
            $table->double('loan_rate', 10, 2)->nullable()->comment('이자율 소수점 2자리까지');
            $table->integer('loan_month')->nullable()->comment('대출 기간 (개월)');
            $table->integer('holding_month')->nullable()->comment('거치 기간 (개월)');

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
