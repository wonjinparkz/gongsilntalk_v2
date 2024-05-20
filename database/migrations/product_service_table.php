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
        Schema::create('product_service', function (Blueprint $table) {
            $table->id()->comment('매물 관리비 항목 아이디');
            $table->integer('product_id')->nullable()->comment('매물 아이디');
            $table->integer('type')->nullable()->comment('관리비 타입 - 0: 청소비, 1: 경비비, 2: 인터넷, 3: 승강기유지비, 4: 수선유지비, 5: 전기세, 6: 수도세, 7: 도시가스비, 8: 기타');

            // Indexes
            $table->timestamps();
        });
        DB::statement("ALTER TABLE product_service COMMENT='매물 관리비'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_service');
    }
};
