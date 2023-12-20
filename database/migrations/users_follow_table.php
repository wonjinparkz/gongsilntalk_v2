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
        Schema::create('users_follows', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('팔로우한 사용자 아이디');
            $table->integer('follow_id')->comment('팔로우 당한 사용자 아이디');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE users_follows COMMENT='사용자 팔로우'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_follows');
    }
};
