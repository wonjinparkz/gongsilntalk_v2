<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// 매거진 테이블
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 매거진
        Schema::create('magazine', function (Blueprint $table) {
            $table->id();
            $table->integer('admins_id')->comment('매거진 작성자');
            $table->integer('type')->comment('매거진 타입 - 0: 공톡유뷰트, 1: 공톡매거진, 2: 공톡뉴스');

            $table->string('title')->comment('매거진 제목');
            $table->string('url')->comment('공톡 유뷰트 URL');
            $table->longText('content')->comment('매거진 내용');

            $table->integer('view_count')->comment('매거진 뷰 횟수');
            $table->integer('like_count')->comment('매거진 추천 횟수');
            $table->integer('is_blind')->comment('상태 - 0 : 공개, 1 : 비공개 ');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE magazine COMMENT='매거진'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magazine');
    }
};
