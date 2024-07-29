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
        Schema::create('cosulting_question', function (Blueprint $table) {
            $table->id()->comment('컨설팅 문의 아이디');
            $table->string('name')->comment('기업 명');
            $table->string('phone')->comment('기업 명');
            $table->string('email')->comment('기업 명');
            $table->longText('content')->comment('기업 명');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE cosulting_question COMMENT='컨설팅 문의'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cosulting_question');
    }
};
