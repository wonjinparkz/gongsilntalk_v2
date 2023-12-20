<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// 매거진 차단
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 매거진 차단
        Schema::create('magazine_block', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('사용자 아이디');
            $table->integer('magazine_id')->comment('매거진 아이디');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE magazine_block COMMENT='매거진 차단'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magazine_block');
    }
};
