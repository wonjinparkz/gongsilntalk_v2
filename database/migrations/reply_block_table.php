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
        // 댓글 차단
        Schema::create('reply_block', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('사용자 아이디');
            $table->integer('reply_id')->comment('댓글 아이디');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply_block');
    }
};
