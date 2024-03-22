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
        Schema::create('proposal_product', function (Blueprint $table) {

            $table->id()->comment('제안 받은 매물 아이디');
            $table->integer('proposal_id')->comment('매물 제안서 아이디');
            $table->string('product_id')->comment('매물 물건 아이디');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE proposal_product COMMENT='제안 받은 물건'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_product');
    }
};
