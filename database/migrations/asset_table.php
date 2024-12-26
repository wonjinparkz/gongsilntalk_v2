<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 내 자산 상세 정보
        Schema::create('asset', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_address_id')->comment('자산 주소 아이디');
            $table->integer('type')->comment('부동산 유형 0-상업용, 1-주거용, 2-분양권');
            $table->integer('type_detail')->comment('부동산 유형 상세 0-지식산업센터, 1-사무실, 2-창고, 3-상가, 4-기숙사, 5-건물, 6-토지/임야, 7-단독 공장, 8-아파트, 9-오피스텔, 10-단독/다가구, 11-다세대/빌라/연립, 12-상가주택, 13-주택, 14-지식산업센터 분양권, 15-상가 분양권, 16-아파트 분양권, 17-오피스텔 분양권');

            $table->string('address_dong')->nullable()->comment('주소 동 정보');
            $table->string('address_detail')->nullable()->comment('주소 호 / 상세 정보');

            $table->integer('area')->nullable()->comment('공급면적 -  타입이 3 또는 4일 경우 대지면적으로 사용 (단위 평)');
            $table->double('square', 10, 2)->nullable()->comment('공급면적 - 타입이 3 또는 4일 경우 대지면적으로 사용 (단위 제곱미터)');
            $table->integer('exclusive_area')->nullable()->comment('전용면적 (단위 평)');
            $table->double('exclusive_square', 10, 2)->nullable()->comment('전용면적(단위 제곱미터)');
            $table->integer('total_floor_area')->nullable()->comment('연면적 타입이 4일 경우에만 사용 (단위 평)');
            $table->double('total_floor_square', 10, 2)->nullable()->comment('연면적 타입이 4일 경우에만 사용 (단위 제곱미터)');

            $table->integer('name_type')->comment('명의구분 0-단독명의, 1-공동명의');
            $table->integer('ownership_share')->nullable()->comment('부동산 공동명의 지분율');
            $table->integer('business_type')->comment('사업자 구분 0-개인사업자, 1-법인사업자, 2-개인');

            $table->integer('tran_type')->nullable()->comment('거래 타입 0-매매, 1-분양권');
            $table->bigInteger('price')->nullable()->comment('매매 - 매매가, 분양권 - 분양가');
            $table->datetime('contracted_at')->nullable()->comment('계약일자');
            $table->datetime('registered_at')->nullable()->comment('등기일');
            $table->double('acquisition_tax_rate', 10, 2)->nullable()->comment('취득 세율');
            $table->bigInteger('etc_price')->nullable()->comment('기타 비용');
            $table->bigInteger('tax_price')->nullable()->comment('세무 비용');
            $table->bigInteger('estate_price')->nullable()->comment('부동산 수수료');

            $table->bigInteger('loan_price')->nullable()->comment('대출 금액');
            $table->double('loan_rate', 10, 2)->nullable()->comment('대출 금리');
            $table->integer('loan_period')->nullable()->comment('대출 기간');
            $table->datetime('loaned_at')->nullable()->comment('대출 일자');
            $table->integer('loan_type')->nullable()->comment('대출 방식');

            $table->integer('is_vacancy')->nullable()->comment('공실 여부 0-공실, 1-계약중, 2-미임대');
            $table->string('tenant_name')->nullable()->comment('임차인 명');
            $table->string('tenant_phone')->nullable()->comment('임차인 연락처');
            $table->integer('pay_type')->nullable()->comment('임대료 납부 방법');
            $table->bigInteger('check_price')->nullable()->comment('보증금');
            $table->bigInteger('month_price')->nullable()->comment('월 임대료');
            $table->string('deposit_day')->nullable()->comment('월세 입금일');
            $table->datetime('started_at')->nullable()->comment('계약 시작일');
            $table->datetime('ended_at')->nullable()->comment('계약 종료일');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset');
    }
};
