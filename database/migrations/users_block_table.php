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
        Schema::create('users_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('users_id')->comment('차단한 사용자 아이디');
            $table->string('block_id')->comment('차단 당한 사용자 아이디');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE users_blocks COMMENT='사용자 차단'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_blocks');
    }
};
