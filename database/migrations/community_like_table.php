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
        // 커뮤니티 좋아요
        Schema::create('community_like', function (Blueprint $table){
            $table->id();
            $table->integer('users_id')->comment('사용자 아이디');
            $table->integer('community_id')->comment('커뮤니티 아이디');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE community_like COMMENT='커뮤니티 좋아요'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_like');
    }
};
