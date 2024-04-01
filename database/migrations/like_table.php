<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 게시글 테이블
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 게시글 좋아요
        Schema::create('like', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('사용자 아이디');
            $table->integer('target_id')->comment('타겟 아이디');
            $table->string('target_type')->comment('타겟 타입');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('like');
    }
};
