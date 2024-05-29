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
        Schema::create('product', function (Blueprint $table) {

            $table->id()->comment('매물 아이디');
            $table->integer('users_id')->nullable()->comment('사용자 아이디');
            $table->string('product_number')->nullable()->comment('매물번호');
            $table->integer('user_type')->nullable()->comment('회원 타입 - 0 : 일반회원, 1 : 중개사');
            $table->integer('state')->nullable()->comment('매물 상태 - 0: 등록 요청, 1: 거래중, 2: 거래완료, 3: 비공개, 4: 등록만료, 5: 등록대기');
            $table->integer('type')->nullable()->comment('매물종류 - 0: 지식산업센터, 1: 사무실, 2: 창고, 3: 상가, 4:기숙사, 5: 건물, 6: 토지/임야, 7: 단독공장, 8: 아파트, 9: 오피스텔, 10: 단독/다가구, 11: 다세대/빌라/연립, 12: 상가주택, 13: 주택, 14: 지식산업센터 분양권, 15: 상가 분양권, 16: 아파트 분양권, 17: 오피스텔 분양권');

            $table->integer('is_map')->nullable()->comment('지도 노출 여부 - 0: 노출, 1: 노출안함');
            $table->string('address_lat')->nullable()->comment('위도');
            $table->string('address_lng')->nullable()->comment('경도');
            $table->bigInteger('region_code')->nullable()->comment('주소 법정동 코드');
            $table->string('region_address')->nullable()->comment('주소 법정동 주소');
            $table->string('address')->nullable()->comment('주소');
            $table->string('address_detail')->nullable()->comment('상세 주소');
            $table->string('address_dong')->nullable()->comment('주소 동 정보');
            $table->string('address_number')->nullable()->comment('주소 호 정보');

            $table->integer('floor_number')->nullable()->comment('해당 층');
            $table->integer('total_floor_number')->nullable()->comment('전체 층');

            $table->string('lowest_floor_number')->nullable()->comment('최저층');
            $table->string('top_floor_number')->nullable()->comment('최고층');

            $table->integer('area')->nullable()->comment('공급면적 -  타입이 3 또는 4일 경우 대지면적으로 사용 (단위 평)');
            $table->double('square', 10, 2)->nullable()->comment('공급면적 - 타입이 3 또는 4일 경우 대지면적으로 사용 (단위 제곱미터)');
            $table->integer('exclusive_area')->nullable()->comment('전용면적 (단위 평)');
            $table->double('exclusive_square', 10, 2)->nullable()->comment('전용면적(단위 제곱미터)');
            $table->integer('total_floor_area')->nullable()->comment('연면적 타입이 4일 경우에만 사용 (단위 평)');
            $table->double('total_floor_square', 10, 2)->nullable()->comment('연면적 타입이 4일 경우에만 사용 (단위 제곱미터)');

            $table->string('approve_date')->nullable()->comment('준공예정일 yyyymd 형식');
            $table->integer('building_type')->nullable()->comment('건축물 용도');

            $table->integer('move_type')->nullable()->comment('입주 타입 - 0 : 즉시입주, 1 : 날짜협의, 2: 직접입력');
            $table->text('move_date')->nullable()->comment('입주 가능일 - 직접입력');

            $table->integer('is_service')->nullable()->comment('관리비 없음 여부 - 0: 관리비 있음, 1: 관리비 없음');
            $table->integer('service_price')->nullable()->comment('관리비 가격');

            $table->integer('loan_type')->nullable()->comment('융자금 타입 - 0: 없음, 1: 30%미만, 2: 30%이상');
            $table->text('loan_price')->nullable()->comment('융자금 가격');

            $table->integer('parking_type')->nullable()->comment('주차 가능 여부 - 0: 선택안함, 1: 가능, 2: 불가능');
            $table->integer('parking_price')->nullable()->comment('주차비 (주차 가능일 경우 null값이면 무료주차)');

            $table->string('comments')->nullable()->comment('한줄 소개');
            $table->longText('contents')->nullable()->comment('성세 설명');
            $table->string('image_link')->nullable()->comment('3D 이미지 링크');
            $table->integer('update_user_type')->nullable()->comment('최종 수정자 - 0: 일반회원, 1: 관리자');
            $table->integer('commission')->nullable()->comment('중개 보수 (부가세 별도)');
            $table->double('commission_rate', 10, 1)->nullable()->comment('상환요율 (%)');

            $table->integer('is_blind')->nullable()->comment('비공개 여부 - 0: 공개, 1: 비공개');
            $table->integer('is_delete')->nullable()->comment('삭제 여부 - 0: 게시중, 1: 삭제');

            // Indexes
            $table->timestamps();
        });
        DB::statement("ALTER TABLE product COMMENT='매물'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
