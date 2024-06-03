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
        // 대출이자 계산기 > 금리변동 내역 테이블
        Schema::create('calculator_loan_rate', function (Blueprint $table) {
            $table->id()->comment('변동 금리 아이디');
            $table->integer('calculator_loan_id')->comment('대출 이자 계산 아이디');
            $table->integer('sequence')->nullable()->comment('회차');
            $table->integer('interest_rate')->nullable()->comment('변동 금리');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('calculator_loan_rate');
    }
};
