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
            $table->string('title')->comment('배너 제목');
            $table->longText('content')->comment('배너 내용');
            $table->integer('type')->comment('배너 타입');
            $table->integer('is_blind')->comment('배너 상태 - 0 : 공개, 1 : 비공개 ');

            $table->timestamp('started_at')->comment('배너 게시 시작일');
            $table->timestamp('ended_at')->comment('배너 게시 종료일');

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
