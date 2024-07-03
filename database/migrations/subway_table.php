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
        Schema::create('subway', function (Blueprint $table) {
            $table->id();
            $table->string('subway_name')->comment('지하철명');
            $table->string('subway_zone')->comment('지역');
            $table->string('x')->comment('경도');
            $table->string('y')->comment('위도');
            $table->string('line')->nullable()->comment('지하철 호선');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE subway COMMENT='지하철역'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('subway');
    }
};
