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
        Schema::create('brtitleinfo', function (Blueprint $table) {
            $table->id()->comment('표지부 아이디');
            $table->string('target_type')->nullable()->comment('타겟 타입');
            $table->integer('target_id')->nullable()->comment('타겟 아이디');
            $table->longText('json_data')->nullable()->comment('json 타입으로 받은 데이터');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE banners COMMENT='표지부 정보'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brtitleinfo');
    }
};
