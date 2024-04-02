<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reply', function (Blueprint $table) {
            $table->id();
            $table->integer('target_id')->nullable()->comment('타겟 아이디');
            $table->string('target_type')->nullable()->comment('타겟 타입');
            $table->integer('author')->comment('작성자 아이디');
            $table->integer('parent_id')->nullable()->comment('대댓글의 부모키');
            $table->integer('depth')->default(0)->comment('대댓글의 깊이');
            $table->longText('content')->comment('댓글의 내용');
            $table->integer('block_count')->comment('차단수')->default(0);
            $table->integer('like_count')->comment('추천수')->default(0);
            $table->integer('report_count')->comment('신고수')->default(0);
            $table->integer('is_blind')->comment('댓글 상태 - false : 공개, true : 비공개')->default(0);
            $table->integer('is_delete')->comment('댓글 상태 - 0 : 게시중, 1 : 삭제')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply');
    }
};
