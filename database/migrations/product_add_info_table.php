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
        Schema::create('product_add_info', function (Blueprint $table) {
            $table->id()->comment('매물 추가정보 아이디');
            $table->integer('product_id')->comment('매물 아이디');
            $table->integer('direction_type')->nullable()->comment('건물 방향 - 0: 동, 1: 서, 2: 남, 3: 북, 4: 북동, 5: 남동, 6: 북서, 7: 남서');
            $table->integer('cooling_type')->nullable()->comment('냉방 종류 - 0: 개별냉방, 1: 중앙냉방, 2: 지역냉방');
            $table->integer('heating_type')->nullable()->comment('난방 종류 - 0: 개별난방, 1: 중앙난방, 2: 지역난방');
            $table->string('weight')->nullable()->comment('하중 (평당)');
            $table->integer('is_elevator')->comment('승강시설 - 0: 없음, 1: 있음');
            $table->integer('is_dock')->comment('도크 단독공장 - 0: 없음, 1: 있음');
            $table->integer('is_hoist')->comment('호이스트 단독공장 - 0: 없음, 1: 있음');
            $table->integer('is_goods_elevator')->nullable()->comment('화물시설 - 0: 없음, 1: 있음');
            $table->integer('interior_type')->nullable()->comment('인테리어 여부 - 0: 선택 안합, 1: 있음, 2: 없음');
            $table->integer('floor_height_type')->nullable()->comment('층고 - 0: 3.5이하, 1: 3.5~4.5, 2: 4.5~5.5, 3: 5.5~6.5, 4: 6.5 이상 (m)');
            $table->integer('wattage_type')->nullable()->comment('사용전력 - 0: 10이하, 1: 10~25, 2: 25~50, 3: 50~100, 4: 100~1000, 5: 1000이상 (kW)');
            $table->integer('current_business_type')->nullable()->comment('현 업종 - 0: 휴게음식점, 1: 일반음식점, 2: 주류점, 3: 오락스포츠, 4: 판매업, 5: 서비스업, 6: 숙박업, 7: 기타업종');
            $table->integer('recommend_business_type')->nullable()->comment('추천 업종 - 0: 휴게음식점, 1: 일반음식점, 2: 주류점, 3: 오락스포츠, 4: 판매업, 5: 서비스업, 6: 숙박업, 7: 기타업종');
            $table->integer('land_use_type')->nullable()->comment('국토이용 - 0: 선택안함, 1: 해당, 2: 미해당');
            $table->integer('city_plan_type')->nullable()->comment('도시 계획 - 0: 선택안함, 1: 있음, 2: 없음');
            $table->integer('building_permit_type')->nullable()->comment('건축허가 - 0: 선택안함, 1: 발급, 2: 미발급');
            $table->integer('land_permit_type')->nullable()->comment('토지 거래 허가 구역 - 0: 선택안함, 1: 해당, 2: 미해당');
            $table->integer('access_load_type')->nullable()->comment('진입도로 - 0: 선택 안함, 1: 있음, 2: 없음');
            $table->integer('room_count')->nullable()->comment('방 수');
            $table->integer('bathroom_count')->nullable()->comment('욕실 수');
            $table->integer('structure_type')->nullable()->comment('구조 - 0: 선택안함, 1: 복층, 2: 1.5룸/주방분리형');
            $table->integer('builtin_type')->nullable()->comment('빌트인 - 0: 선택안함, 1: 있음, 2: 없음');
            $table->integer('declare_type')->nullable()->comment('전입신고 - 0: 선택안함, 1: 가능, 2: 불가능');
            $table->integer('is_option')->nullable()->comment('옵션 여부 - 0 : 없음, 1: 있음');

            // Indexes
            $table->timestamps();
        });
        DB::statement("ALTER TABLE product_price COMMENT='매물 추가정보'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_add_info');
    }
};
