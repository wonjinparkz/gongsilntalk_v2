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
        //
        Schema::create('corp_product_address', function (Blueprint $table) {
            $table->id()->comment('매물 주소 아이디');
            $table->integer('users_id')->comment('사용자 아이디');
            $table->string('city')->comment('구분 주소명');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('corp_product_address');
    }
};
