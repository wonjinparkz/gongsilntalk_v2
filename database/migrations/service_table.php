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
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->integer('admins_id')->comment('관리자 id');
            $table->integer('order')->unique()->nullable()->comment('노출 순서');
            $table->integer('type')->comment('서비스 타입 - 0: 메인, 1: 추천 분양현장, 2:실시간 매물지도, 3: 내 자산관리, 4: 수익률 계산기');
            $table->string('name')->comment('서비스 명');
            $table->string('title')->nullable()->comment('서비스 제목');
            $table->longText('content')->comment('서비스 내용');
            $table->string('url')->nullable()->comment('서비스 연결 페이지 링크');
            $table->integer('is_blind')->default(0)->comment('서비스 상태 - 0 : 공개, 1 : 비공개 ');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE service COMMENT='서비스 정보'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};
