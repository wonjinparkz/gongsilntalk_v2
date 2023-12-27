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
        Schema::create('lawd_cd', function (Blueprint $table) {
            $table->id();
            $table->string('lawd_cd')->comment('법정동코드');
            $table->string('full_lawd')->comment('전체법정동명');
            $table->string('sido')->comment('시도명');
            $table->string('sigugun')->comment('시군구명');
            $table->string('lawd')->comment('법정동명');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE faqs COMMENT='법정동코드'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('lawd_cd');
    }
};
