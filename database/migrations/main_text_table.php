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
        Schema::create('main_text', function (Blueprint $table) {
            $table->id();
            $table->integer('admins_id')->comment('관리자 id');
            $table->integer('order')->nullable()->comment('노출 순서');
            $table->string('title')->comment('텍스트 내용');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE main_text COMMENT='메인 텍스트 관리'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_text');
    }
};
