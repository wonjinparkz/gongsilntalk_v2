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
         //
         Schema::create('password_reset', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('사용자 id');
            $table->longText('token')->comment('토큰');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE password_reset COMMENT='비밀번호 찾기'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset');
    }
};
