<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// 커뮤니티 카테고리 테이블
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 게시판 종류
        Schema::create('community_category', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('보드 제목');
            $table->string('content')->comment('보드 내용');
            $table->integer('is_blind')->comment('보드 상태 - 0 : 공개, 1 : 비공개 ');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE community_category COMMENT='커뮤니티 카테고리'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_category');
    }
};
