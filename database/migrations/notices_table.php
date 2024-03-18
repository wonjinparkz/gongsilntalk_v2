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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->integer('admins_id')->comment('관리자 id');
            $table->string('title')->comment('공지사항 제목');
            $table->longText('content')->comment('공지사항 내용');
            $table->integer('is_blind')->default(0)->comment('게시 - 0 : 공개, 1 : 비공개 ');
            $table->integer('view_count')->comment('공지사항 뷰 횟수');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE notices COMMENT='공지사항'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
