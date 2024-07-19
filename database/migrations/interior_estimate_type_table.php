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
        Schema::create('interior_estimate_type', function (Blueprint $table) {
            $table->id()->comment('인테리어 견적 타입 아이디');
            $table->integer('interior_estimate_id')->comment('인테리어 견적 아이디');
            $table->integer('type')->comment('인테리어 타입 - 0: 전체 인테리어, 1: 부분 인테리어, 2: 상담 후 결정');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE interior_estimate_type COMMENT='인테리어 견적 타입'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('interior_estimate_type');
    }
};
