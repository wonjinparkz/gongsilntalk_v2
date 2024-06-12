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
        Schema::create('alarms', function (Blueprint $table) {
            $table->id();
            $table->string('users_id')->comment('사용자 id');
            $table->integer('index')->comment('인덱스');
            $table->string('title')->comment('제목');
            $table->longText('body')->comment('내용');
            $table->longText('msg')->comment('데이터');
            $table->integer('product_id')->nullable()->comment('매물 아이디');
            $table->integer('tour_users_id')->nullable()->comment('투어 받는 사용자 아이디');
            $table->timestamp('readed_at')->nullable()->comment('알림 읽은 시간');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE alarms COMMENT='알림'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('alarms');
    }
};
