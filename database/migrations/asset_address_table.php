<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 내 자산 주소
        Schema::create('asset_address', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('사용자 아이디');
            $table->integer('is_temporary')->comment('가(임시) 주소 여부 0-아님, 1-가 주소');
            $table->integer('is_unregistered')->comment('미등기 여부 0-아님, 1-미등기');
            $table->string('address_lat')->comment('위도');
            $table->string('address_lng')->comment('경도');
            $table->bigInteger('region_code')->comment('법정동 코드');
            $table->string('region_address')->comment('법정동 주소');
            $table->string('address')->comment('도로명 주소');
            $table->string('old_address')->comment('지번 주소');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_address');
    }
};
