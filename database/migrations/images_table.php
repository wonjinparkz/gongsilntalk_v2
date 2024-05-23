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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path')->unique()->comment('이미지 경로');
            $table->integer('width')->comment('이미지 가로');
            $table->integer('height')->comment('이미지 세로');
            $table->string('target_type')->nullable()->comment('타겟 타입');
            $table->integer('target_id')->nullable()->comment('타겟 아이디');
            $table->integer('type')->comment('이미지 타입');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE images COMMENT='이미지 정보'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
