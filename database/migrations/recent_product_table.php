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
        // 최근 본 상품
        Schema::create('recent_product', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('사용자 아이디');
            $table->integer('product_id')->comment('상품 아이디');
            $table->string('product_type')->comment('타겟 타입 0-일반 매물, 1-분양 매물');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recent_product');
    }
};
