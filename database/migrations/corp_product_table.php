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
        Schema::create('corp_product', function (Blueprint $table) {

            $table->id()->comment('기업 매물 아이디');
            $table->bigInteger('corp_proposal_id')->comment('기업 제안서 아이디');
            $table->integer('product_type')->comment('매물 타입 - 0: 상업용, 1: 주거용');
            $table->integer('type')->comment('매물종류 - 0: 지식산업센터, 1: 사무실, 2: 창고, 3: 상가, 4: 건물, 5: 토지/임야, 6: 단독공장');
            $table->string('address_lat')->comment('위도');
            $table->string('address_lng')->comment('경도');
            $table->string('address')->comment('주소');
            $table->string('address_detail')->comment('상세 주소');
            $table->string('product_name')->comment('건물명');
            $table->integer('exclusive_area')->comment('전용 면적 (평)');
            $table->double('exclusive_square', 10, 1)->comment('전용 면적 (제곱미터)');
            $table->integer('floor_number')->comment('해당 층');
            $table->integer('total_floor_number')->comment('전체 층');
            $table->integer('move_type')->comment('입주 타입 - 0: 선택 안함, 1: 즉시입주, 2: 날짜 협의, 3: 직접입력');
            $table->string('move_date')->nullable()->comment('입주 가능일 - null일 경우 즉시 입주');
            $table->integer('is_service')->comment('관리비 없음 여부 - 0: 관리비 있음, 1: 관리비 없음');
            $table->integer('service_price')->nullable()->comment('관리비 가격');
            $table->integer('heating_type')->nullable()->comment('난방 종류 - 0: 개별난방, 1: 중앙난방, 2: 지역난방');
            $table->integer('parking_count')->nullable()->comment('주차 가능 대수');
            $table->longText('product_content')->nullable()->comment('건물 특장점');
            $table->longText('content')->nullable()->comment('요청사항');
            $table->integer('is_delete')->default(0)->comment('삭제여부 - 0: 게시중, 1: 삭제함');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE corp_product COMMENT='매물 제안서'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corp_product');
    }
};
