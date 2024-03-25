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
        Schema::create('proposal_region', function (Blueprint $table) {

            $table->id()->comment('제안서 선호 지역 아이디');
            $table->integer('proposal_id')->comment('매물 제안서 아이디');
            $table->string('region_code')->comment('지역 코드');
            $table->string('city_name')->comment('시 이름');
            $table->string('region_name')->comment('구 이름');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE proposal_region COMMENT='매물 제안서'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_region');
    }
};
