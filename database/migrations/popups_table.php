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
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->integer('admins_id')->comment('관리자 id');
            $table->integer('order')->unique()->nullable()->comment('노출 순서');
            $table->string('name')->comment('팝업명');
            $table->string('url')->nullable()->comment('연결 페이지 링크');
            $table->string('type')->comment('팝업 타입 - 0: PC, 1: 모바일');
            $table->integer('is_blind')->comment('공개 - 0 : 공개, 1 : 비공개 ');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE popups COMMENT='팝업 관리'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popups');
    }
};
