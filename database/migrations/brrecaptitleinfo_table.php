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
        Schema::create('brrecaptitleinfo', function (Blueprint $table) {
            $table->id()->comment('총괄표제부 아이디');
            $table->string('target_type')->nullable()->comment('타겟 타입');
            $table->integer('target_id')->nullable()->comment('타겟 아이디');
            $table->longText('json_data')->nullable()->comment('json 타입으로 받은 데이터');
            $table->timestamps();
            $table->index(['target_type', 'target_id']); // 빠른 조회
        });
        DB::statement("ALTER TABLE brrecaptitleinfo COMMENT='총괄표제부 정보'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brrecaptitleinfo');
    }
};
