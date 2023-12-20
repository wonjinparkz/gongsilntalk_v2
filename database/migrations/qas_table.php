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
        Schema::create('qas', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('작성자 id');
            $table->string('title')->comment('QA 제목');
            $table->longText('content')->comment('QA 내용');
            $table->integer('category')->comment('QA 카테고리 (0:신고, 1:건의, 2:기타)');
            $table->longText('reply_content')->nullable()->comment('QA 답변');
            $table->timestamp('reply_date')->nullable()->comment('답변일');
            $table->integer('is_reply')->comment('답변 유무 (0:미답변, 1:답변)');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE qas COMMENT='1:1 문의'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('qas');
    }
};
