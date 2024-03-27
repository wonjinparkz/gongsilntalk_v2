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
        Schema::create('proposal', function (Blueprint $table) {

            $table->id()->comment('매물 제안서 아이디');
            $table->bigInteger('users_id')->comment('유저 아이디');
            $table->string('title')->comment('제안서 명');
            $table->integer('type')->comment('매물 타입 - 0: 지식산업센터, 1: 사무실, 2: 창고,  3: 상가, 6: 단독공장');
            $table->integer('area')->comment('희망 면적 (평)');
            $table->double('square', 10, 1)->comment('희망 면적 (제곱미터)');
            $table->integer('business_type')->nullable()->comment('업종 (상가가 아닐 경우에만 선택)');
            $table->integer('move_type')->comment('입주 타입 - 0: 즉시입주, 1: 날짜 협의, 2: 직접 입력');
            $table->integer('users_count')->comment('사용 인원');
            $table->string('start_move_date')->nullable()->comment('입주 시작일');
            $table->string('ended_move_date')->nullable()->comment('입주 종료일');
            $table->integer('payment_type')->comment('거래방식 - 0: 매매, 1: 임대');
            $table->integer('price')->comment('매매 - 매매가, 임대 - 보증금');
            $table->integer('month_price')->nullable()->comment('월 임대료');
            $table->string('client_name')->comment('의뢰자 이름 & 회사명');
            $table->integer('floor_type')->comment('(상가일 경우에만 선택) 희망 상가 층 - 0: 상관없음, 1: 1층, 2: 2층 이상');
            $table->integer('interior_type')->comment('인테리어 필요 여부 - 0: 선택 안함, 1: 필요해요, 2: 필요 없어요');
            $table->longText('content')->comment('요청사항');
            $table->integer('is_delete')->default(0)->comment('삭제여부 - 0: 게시중, 1: 삭제함');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE proposal COMMENT='매물 제안서'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal');
    }
};
