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
        Schema::create('consulting_question', function (Blueprint $table) {
            $table->id()->comment('컨설팅 문의 아이디');
            $table->string('name')->comment('기업 명');
            $table->string('phone')->comment('기업 명');
            $table->string('email')->comment('기업 명');
            $table->longText('content')->comment('기업 명');
            $table->integer('state')->comment('상태');
            $table->integer('is_delete')->comment('문의 삭제 상태 - 0 : 게시중, 1 : 삭제 ');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE consulting_question COMMENT='컨설팅 문의'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consulting_question');
    }
};
