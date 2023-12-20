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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id')->unique()->comment('관리자 아이디');
            $table->string('password')->comment('관리자 비밀번호');
            $table->string('name')->comment('관리자 이름');
            $table->string('phone')->comment('관리자 전화번호');
            $table->integer('state')->comment('관리자 상태 : 0 - 이용중, 1 - 사용 중지');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE admins COMMENT='관리자 정보'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
