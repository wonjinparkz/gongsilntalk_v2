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
        // 행정구역 좌표
        Schema::create('region_coordinate', function (Blueprint $table) {
            $table->id();
            $table->string('sido')->comment('시도');
            $table->string('sigungu')->nullable()->comment('시군구');
            $table->string('dong')->nullable()->comment('읍면동');
            $table->string('address_lng')->nullable()->comment('경도 좌표 X');
            $table->string('address_lat')->nullable()->comment('위도 좌표 Y');
            $table->string('bjdCode')->nullable()->comment('시군구 코드');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('region_coordinate');
    }
};
