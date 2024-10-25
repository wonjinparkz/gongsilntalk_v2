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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->integer('admins_id')->comment('관리자 id');
            $table->integer('type')->nullable()->comment('배너 타입 - 0: 메인베너, 1: 하단배너');
            $table->integer('order')->nullable()->comment('노출 순서');
            $table->string('name')->nullable()->comment('배너 명');
            $table->string('title')->comment('배너 제목');
            $table->longText('content')->nullable()->comment('배너 내용');
            $table->string('url')->nullable()->comment('배너 연결 페이지 링크');
            $table->integer('is_blind')->default(0)->comment('배너 상태 - 0 : 공개, 1 : 비공개 ');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE banners COMMENT='배너 정보'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
