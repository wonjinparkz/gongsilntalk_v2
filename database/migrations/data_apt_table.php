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
        Schema::create('data_apt', function (Blueprint $table) {
            $table->id();
            // 아파트 정보
            $table->string('as1', 100)->nullable()->comment('시도');
            $table->string('as2', 100)->nullable()->comment('시구군');
            $table->string('as3', 100)->nullable()->comment('읍면동');
            $table->string('as4', 100)->nullable()->comment('리');
            $table->string('bjdCode', 100)->nullable()->comment('법정동코드');
            $table->string('kaptCode', 100)->nullable()->comment('아파트 단지 코드');
            $table->string('kaptName', 100)->nullable()->comment('아파트 이름');

            // 아파트 기본 정보
            $table->boolean('is_base_info')->default(0)->comment('기본 정보 세팅 여부');
            $table->string('kaptAddr', 100)->nullable()->comment('법정동주소');
            $table->string('codeSaleNm', 100)->nullable()->comment('분양형태');
            $table->string('codeHeatNm', 100)->nullable()->comment('난방방식');
            $table->string('kaptTarea', 100)->nullable()->comment('건축물대장상 연면적(㎡)');
            $table->string('kaptDongCnt', 100)->nullable()->comment('동수');
            $table->string('kaptdaCnt', 100)->nullable()->comment('세대수');
            $table->string('kaptBcompany', 100)->nullable()->comment('시공사');
            $table->string('kaptAcompany', 100)->nullable()->comment('시행사');
            $table->string('kaptTel', 100)->nullable()->comment('관리사무소연락처');
            $table->string('kaptFax', 100)->nullable()->comment('관리사무소팩스');
            $table->string('kaptUrl', 100)->nullable()->comment('홈페이지주소');
            $table->string('codeAptNm', 100)->nullable()->comment('단지분류');
            $table->string('doroJuso', 100)->nullable()->comment('도로명주소');
            $table->string('hoCnt', 100)->nullable()->comment('호수');
            $table->string('codeMgrNm', 100)->nullable()->comment('관리방식');
            $table->string('codeHallNm', 100)->nullable()->comment('복도유형');
            $table->string('kaptUsedate', 100)->nullable()->comment('사용승인일');
            $table->string('kaptMarea', 100)->nullable()->comment('관리비부과면적(㎡)');
            $table->string('kaptMparea_60', 100)->nullable()->comment('60㎡ 이하');
            $table->string('kaptMparea_85', 100)->nullable()->comment('60㎡ ~ 85㎡ 이하');
            $table->string('kaptMparea_135', 100)->nullable()->comment('85㎡ ~ 135㎡ 이하');
            $table->string('kaptMparea_136', 100)->nullable()->comment('135㎡ 초과');
            $table->string('privArea', 100)->nullable()->comment('단지 전용면적합(㎡)');


            // 아파트 상세 정보
            $table->boolean('is_detail_info')->default(0)->comment('기본 정보 세팅 여부');
            $table->string('codeMgr', 100)->nullable()->comment('일반관리방식');
            $table->string('kaptMgrCnt', 100)->nullable()->comment('일반관리인원');
            $table->string('kaptCcompany', 100)->nullable()->comment('일반관리 계약업체(자치관리일 경우 없을 수 있음)');
            $table->string('codeSec', 100)->nullable()->comment('경비관리방식');
            $table->string('kaptdScnt', 100)->nullable()->comment('경비관리인원');
            $table->string('kaptdSecCom', 100)->nullable()->comment('경비관리 계약업체(자치관리일 경우 없을 수 있음)');
            $table->string('codeClean', 100)->nullable()->comment('청소관리방식');
            $table->string('kaptdClcnt', 100)->nullable()->comment('청소관리인원');
            $table->string('codeGarbage', 100)->nullable()->comment('음식물처리방법');
            $table->string('codeDisinf', 100)->nullable()->comment('소독관리방식');
            $table->string('kaptdDcnt', 100)->nullable()->comment('소독관리 연간 소독횟수');
            $table->string('disposalType', 100)->nullable()->comment('소독방법');
            $table->string('codeStr', 100)->nullable()->comment('건물구조');
            $table->string('kaptdEcapa', 100)->nullable()->comment('수전용량');
            $table->string('codeEcon', 100)->nullable()->comment('세대전기계약방식');
            $table->string('codeEmgr', 100)->nullable()->comment('전기안전관리자 법정선임여부');
            $table->string('codeFalarm', 100)->nullable()->comment('화재수신반방식');
            $table->string('codeWsupply', 100)->nullable()->comment('급수방식');
            $table->string('codeElev', 100)->nullable()->comment('승강기관리형태');
            $table->string('kaptdEcnt', 100)->nullable()->comment('승강기대수(승객용+화물용+승객/화물+장애우+비상용+기타)');
            $table->string('kaptdPcnt', 100)->nullable()->comment('주차대수(지상)');
            $table->string('kaptdPcntu', 100)->nullable()->comment('주차대수(지하)');
            $table->string('codeNet', 100)->nullable()->comment('주차관제.홈네트워크');
            $table->string('kaptdCccnt', 100)->nullable()->comment('CCTV 카메라 수');
            $table->string('welfareFacility', 100)->nullable()->comment('부대시설 및 복리시설');
            $table->string('kaptdWtimebus', 100)->nullable()->comment('버스정류장 거리');
            $table->string('subwayLine', 100)->nullable()->comment('지하철호선');
            $table->string('subwayStation', 100)->nullable()->comment('지하철역명');
            $table->string('kaptdWtimesub', 100)->nullable()->comment('지하철역 거리');
            $table->string('convenientFacility', 100)->nullable()->comment('편의시설(관공서, 병원, 백화점, 대형상가, 공원, 기타)');
            $table->string('educationFacility', 100)->nullable()->comment('교육시설(초등학교, 중학교, 고등학교, 대학교)');


            // 지도 정보
            $table->boolean('is_map_info')->default(0)->comment('지도 정보 세팅 여부');
            $table->string('x')->nullable()->comment('경도');
            $table->string('y')->nullable()->comment('위도');


            $table->timestamps();

            $table->unique('kaptCode');

            $table->string('complex_name')->nullable()->comment('유사 단지명 (,으로 구분지어 사용)');

            $table->boolean('is_pnu')->default(0)->comment('pnu 세팅 여부');
            $table->string('pnu')->nullable()->comment('pnu');

            $table->boolean('is_building_ledger')->default(0)->comment('표제부 세팅 여부');

            $table->longText('polygon_coordinates')->nullable()->comment('플리곤 좌표');
            $table->longText('characteristics_json')->nullable()->comment('토지특성 속성 json형태');
            $table->longText('useWFS_json')->nullable()->comment('토지이용계획WFS json형태');
        });

        DB::statement("ALTER TABLE data_apt COMMENT='법정동코드'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('data_apt');
    }
};
