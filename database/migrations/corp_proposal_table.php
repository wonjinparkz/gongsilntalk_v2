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
        Schema::create('corp_proposal', function (Blueprint $table) {
            $table->id()->comment('기업 제안서 아이디');
            $table->bigInteger('users_id')->comment('유저 아이디');
            $table->string('corp_name')->comment('기업 명');
            $table->string('position')->comment('중개사 직책');
            $table->integer('is_delete')->default(0)->comment('삭제여부 - 0: 게시중, 1: 삭제함');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE corp_proposal COMMENT='기업 이전 제안서'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corp_proposal');
    }
};
