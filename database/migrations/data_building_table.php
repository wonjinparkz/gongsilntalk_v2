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
        Schema::create('data_building', function (Blueprint $table) {
            $table->id();
            // 건물 정보
            $table->string('as1')->nullable()->comment('시도');
            $table->string('as2')->nullable()->comment('시구군');
            $table->string('as3')->nullable()->comment('읍면동');
            $table->string('as4')->nullable()->comment('리');
            $table->string('bjdCode')->nullable()->comment('법정동코드');
            $table->string('kbuildingName')->nullable()->comment('건물 이름');

            // 건물 기본 정보
            $table->string('kbuildingAddr')->nullable()->comment('법정동주소');
            $table->string('codeSaleNm')->nullable()->comment('분양형태');
            $table->string('codeHeatNm')->nullable()->comment('난방방식');
            $table->string('kbuildingTarea')->nullable()->comment('건축물대장상 연면적(㎡)');
            $table->string('kbuildingDongCnt')->nullable()->comment('동수');
            $table->string('kbuildingdaCnt')->nullable()->comment('세대수');
            $table->string('kbuildingBcompany')->nullable()->comment('시공사');
            $table->string('kbuildingAcompany')->nullable()->comment('시행사');
            $table->string('kbuildingTel')->nullable()->comment('관리사무소연락처');
            $table->string('kbuildingFax')->nullable()->comment('관리사무소팩스');
            $table->string('kbuildingUrl')->nullable()->comment('홈페이지주소');
            $table->string('codeAptNm')->nullable()->comment('단지분류');
            $table->string('doroJuso')->nullable()->comment('도로명주소');
            $table->string('hoCnt')->nullable()->comment('호수');
            $table->string('codeMgrNm')->nullable()->comment('관리방식');
            $table->string('codeHallNm')->nullable()->comment('복도유형');
            $table->string('kbuildingUsedate')->nullable()->comment('사용승인일');
            $table->string('kbuildingMarea')->nullable()->comment('관리비부과면적(㎡)');
            $table->string('kbuildingMparea_60')->nullable()->comment('60㎡ 이하');
            $table->string('kbuildingMparea_85')->nullable()->comment('60㎡ ~ 85㎡ 이하');
            $table->string('kbuildingMparea_135')->nullable()->comment('85㎡ ~ 135㎡ 이하');
            $table->string('kbuildingMparea_136')->nullable()->comment('135㎡ 초과');
            $table->string('privArea')->nullable()->comment('단지 전용면적합(㎡)');


            // 건물 상세 정보
            $table->string('codeMgr')->nullable()->comment('일반관리방식');
            $table->string('kbuildingMgrCnt')->nullable()->comment('일반관리인원');
            $table->string('kbuildingCcompany')->nullable()->comment('일반관리 계약업체(자치관리일 경우 없을 수 있음)');
            $table->string('codeSec')->nullable()->comment('경비관리방식');
            $table->string('kbuildingdScnt')->nullable()->comment('경비관리인원');
            $table->string('kbuildingdSecCom')->nullable()->comment('경비관리 계약업체(자치관리일 경우 없을 수 있음)');
            $table->string('codeClean')->nullable()->comment('청소관리방식');
            $table->string('kbuildingdClcnt')->nullable()->comment('청소관리인원');
            $table->string('codeGarbage')->nullable()->comment('음식물처리방법');
            $table->string('codeDisinf')->nullable()->comment('소독관리방식');
            $table->string('kbuildingdDcnt')->nullable()->comment('소독관리 연간 소독횟수');
            $table->string('disposalType')->nullable()->comment('소독방법');
            $table->string('codeStr')->nullable()->comment('건물구조');
            $table->string('kbuildingdEcapa')->nullable()->comment('수전용량');
            $table->string('codeEcon')->nullable()->comment('세대전기계약방식');
            $table->string('codeEmgr')->nullable()->comment('전기안전관리자 법정선임여부');
            $table->string('codeFalarm')->nullable()->comment('화재수신반방식');
            $table->string('codeWsupply')->nullable()->comment('급수방식');
            $table->string('codeElev')->nullable()->comment('승강기관리형태');
            $table->string('kbuildingdEcnt')->nullable()->comment('승강기대수(승객용+화물용+승객/화물+장애우+비상용+기타)');
            $table->string('kbuildingdPcnt')->nullable()->comment('주차대수(지상)');
            $table->string('kbuildingdPcntu')->nullable()->comment('주차대수(지하)');
            $table->string('codeNet')->nullable()->comment('주차관제.홈네트워크');
            $table->string('kbuildingdCccnt')->nullable()->comment('CCTV 카메라 수');
            $table->string('welfareFacility')->nullable()->comment('부대시설 및 복리시설');
            $table->string('kbuildingdWtimebus')->nullable()->comment('버스정류장 거리');
            $table->string('subwayLine')->nullable()->comment('지하철호선');
            $table->string('subwayStation')->nullable()->comment('지하철역명');
            $table->string('kbuildingdWtimesub')->nullable()->comment('지하철역 거리');
            $table->string('convenientFacility')->nullable()->comment('편의시설(관공서, 병원, 백화점, 대형건물, 공원, 기타)');
            $table->string('educationFacility')->nullable()->comment('교육시설(초등학교, 중학교, 고등학교, 대학교)');


            // 지도 정보
            $table->string('x')->nullable()->comment('경도');
            $table->string('y')->nullable()->comment('위도');


            $table->timestamps();

            $table->string('complex_name')->nullable()->comment('유사 단지명 (,으로 구분지어 사용)');

            $table->string('pnu')->nullable()->comment('pnu');
            $table->longText('polygon_coordinates')->nullable()->comment('플리곤 좌표');
            $table->longText('characteristics_json')->nullable()->comment('토지특성 속성 json형태');
            $table->longText('useWFS_json')->nullable()->comment('토지이용계획WFS json형태');

            $table->integer('is_blind')->default(0)->comment('비공개 설정 - 0:공개, 1:비공개');
        });

        DB::statement("ALTER TABLE data_building COMMENT='건물 정보'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('data_building');
    }
};
