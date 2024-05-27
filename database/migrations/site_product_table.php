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
        Schema::create('site_product', function (Blueprint $table) {
            $table->id()->comment('분양현장 매물 아이디');
            $table->integer('admins_id')->nullable()->comment('작성자 - 관리자');
            $table->integer('region_type')->nullable()->comment('지역 선택 - 0: 서울, 1: 성수동, 2: 문정동, 3: 영등포, 4: 가산/구로, 5: 인천/부천, 6: 시흥/안산, 7: 과천/광명, 8: 안양/군포, 9: 수원/의왕, 10: 하남/성남, 11: 김포/고양, 12: 구리/남양주, 13: 동탄/용인, 14: 오산/평택, 15: 부산, 16: 기타');
            $table->string('address_lat')->nullable()->comment('위도');
            $table->string('address_lng')->nullable()->comment('경도');
            $table->bigInteger('region_code')->nullable()->comment('주소 법정동 코드');
            $table->string('region_address')->nullable()->comment('주소 법정동 주소');
            $table->string('address')->nullable()->comment('주소');
            $table->string('product_name')->nullable()->comment('건물명');
            $table->string('title')->nullable()->comment('제목');
            $table->longText('contents')->nullable()->comment('세부 내용');
            $table->string('min_floor')->nullable()->comment('규모 최저 층');
            $table->string('max_floor')->nullable()->comment('규모 최고 층');
            $table->integer('dong_count')->nullable()->comment('규모 총 동');
            $table->integer('parking_count')->nullable()->comment('규모 총 주차대수');
            $table->integer('generation_count')->nullable()->comment('규모 총 세대 수');
            $table->string('comments')->nullable()->comment('한줄 소개');
            $table->integer('area')->nullable()->comment('대지면적으로 사용 (단위 평)');
            $table->double('square', 10, 2)->nullable()->comment('대지면적으로 사용 (단위 제곱미터)');
            $table->integer('building_area')->nullable()->comment('건축면적 (단위 평)');
            $table->double('building_square', 10, 2)->nullable()->comment('건축면적(단위 제곱미터)');
            $table->integer('total_floor_area')->nullable()->comment('연면적  (단위 평)');
            $table->double('total_floor_square', 10, 2)->nullable()->comment('연면적 (단위 제곱미터)');
            $table->double('floor_area_ratio', 10, 2)->nullable()->comment('용적률 (%)');
            $table->double('builging_ratio', 10, 2)->nullable()->comment('건폐율(%)');
            $table->string('completion_date')->nullable()->comment('준공일 (텍스트 입력)');
            $table->string('expected_move_date')->nullable()->comment('입주예정일 (텍스트 입력)');
            $table->string('developer')->nullable()->comment('시행사');
            $table->string('comstruction_company')->nullable()->comment('시공사');
            $table->integer('is_sale')->nullable()->comment('분양 여부 - 0: 분양예정, 1: 분양중');
            $table->integer('is_delete')->nullable()->comment('삭제 여부 - 0: 게시중, 1: 삭제함');

            // Indexes
            $table->timestamps();
        });

        DB::statement("ALTER TABLE product COMMENT='분양현장 매물'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_product');
    }
};
