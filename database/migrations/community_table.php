<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// 커뮤니티 테이블
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 커뮤니티 글
        Schema::create('community', function (Blueprint $table) {
            $table->id();
            $table->integer('community_category_id')->comment('커뮤니티 카테고리 아이디');
            $table->integer('users_id')->comment('작성 사용자 아이디');
            $table->string('title')->comment('제목');
            $table->string('content')->comment('내용');
            $table->integer('is_blind')->comment('커뮤니티 게시 - 0 : 공개, 1 : 비공개 ');
            $table->integer('is_delete')->comment('댓글 상태 - 0 : 게시중, 1 : 삭제 ');
            $table->integer('view_count')->comment('뷰 횟수');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE community COMMENT='게시글'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community');
    }
};
