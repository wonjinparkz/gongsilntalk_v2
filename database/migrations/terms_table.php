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
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->integer('admins_id')->comment('작성자 id');
            $table->string('title')->comment('약관 제목');
            $table->longText('content')->comment('약관 내용');
            $table->integer('kind')->comment('약관 종류 0 : 약관, 1: 개인정보 처리방침');
            $table->string('type')->comment('약관 타입 - 0: 일반사용자, 1: 중개사');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE terms COMMENT='이용약관'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
