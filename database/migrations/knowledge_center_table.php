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

        Schema::create('knowledge_center', function (Blueprint $table) {
            $table->id()->comment('지식산업 센터 아이디');
            $table->bigInteger('admins_id')->comment('관리자 아이디');
            $table->string('address_lat')->comment('위도');
            $table->string('address_lng')->comment('경도');
            $table->string('address')->comment('주소');
            $table->string('pnu')->comment('pnu코드 (필지고유번호 19자리중 최소 8자리(시도[2]+시군구[3]+읍면동[3]) + 산 여부(대지=1, 산=2) + 지번(본번 4자리, 부번 4자리))');
            $table->longText('polygon_coordinates')->comment('플리곤 좌표');
            $table->longText('characteristics_json')->comment('토지특성 속성 json형태');
            $table->longText('useWFS_json')->comment('토지이용계획WFS json형태');
            $table->string('product_name')->comment('건물명');
            $table->string('subway_name')->comment('지하철 역 명');
            $table->string('subway_distance')->comment('지하철 거리');
            $table->string('subway_time')->comment('지하철 거리 시간');
            $table->string('completion_date')->comment('준공일 (텍스트 입력)');
            $table->double('sale_min_price', 10, 1)->comment('매매호가 최저가 (만원)');
            $table->double('sale_mid_price', 10, 1)->comment('매매호가 평균가 (만원)');
            $table->double('sale_max_price', 10, 1)->comment('매매호가 최고가 (만원)');
            $table->double('lease_min_price', 10, 1)->comment('임대호가 최저가 (만원)');
            $table->double('lease_mid_price', 10, 1)->comment('임대호가 평균가 (만원)');
            $table->double('lease_max_price', 10, 1)->comment('임대호가 최고가 (만원)');
            $table->integer('area')->comment('대지면적으로 사용 (단위 평)');
            $table->double('square', 10, 2)->comment('대지면적으로 사용 (단위 제곱미터)');
            $table->integer('building_area')->comment('건축면적 (단위 평)');
            $table->double('building_square', 10, 2)->comment('건축면적(단위 제곱미터)');
            $table->integer('total_floor_area')->comment('연면적  (단위 평)');
            $table->double('total_floor_square', 10, 2)->comment('연면적 (단위 제곱미터)');
            $table->string('min_floor')->comment('규모 최저 층');
            $table->string('max_floor')->comment('규모 최고 층');
            $table->string('parking_count')->comment('규모 총 주차대수');
            $table->string('generation_count')->nullable()->comment('규모 총 세대 수');
            $table->string('developer')->nullable()->comment('시행사');
            $table->string('comstruction_company')->nullable()->comment('시공사');
            $table->longText('traffic_info')->nullable()->comment('교통정보');
            $table->longText('site_contents')->nullable()->comment('현장설명');
            $table->string('comments')->nullable()->comment('한줄요약');
            $table->longText('bus_stop_contents')->nullable()->comment('버스 정류장 거리');
            $table->longText('facilities_contents')->nullable()->comment('편의시설');
            $table->longText('education_contents')->nullable()->comment('교육시설');
            $table->integer('is_blind')->default(0)->comment('블라인드 여부 - 0: 공개, 1: 비공개');
            $table->integer('is_delete')->default(0)->comment('삭제 여부 - 0: 게시중, 1: 삭제됨');
            $table->timestamps();

        });

        DB::statement("ALTER TABLE knowledge_center COMMENT='지식산업산테'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('knowledge_center');
    }
};
