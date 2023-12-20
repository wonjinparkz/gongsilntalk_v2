<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// 매거진 카테고리 테이블
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 매거진 카테고리
        Schema::create('magazine_category', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('매거진 카테고리 제목');
            $table->integer('order')->comment('순서');
            $table->integer('is_blind')->comment('0 : 공개, 1 : 비공개 ');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE magazine_category COMMENT='매거진 카테고리'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magazine_category');
    }
};
