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
        Schema::create('site_product_alarms', function (Blueprint $table) {
            $table->id();
            $table->string('users_id')->comment('사용자 id');
            $table->integer('site_product_id')->comment('분양매물 아이디');
            $table->integer('is_dday')->nullable()->comment('당일 알림 여부');
            $table->integer('is_oneday')->nullable()->comment('하루전 알림 여부');
            $table->integer('is_week')->nullable()->comment('일주일전 알림 여부');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE alarms COMMENT='분양매물 알람'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('site_product_alarms');
    }
};
