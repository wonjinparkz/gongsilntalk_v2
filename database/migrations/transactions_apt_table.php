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
        Schema::create('transactions_apt', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('아파트 거래 타입 - 0: 매매, 1: 전월세');
            $table->string('transactionPrice')->nullable()->comment('거래금액 - 전월세일 경우 보증금액');
            $table->integer('constructionYear')->nullable()->comment('건축년도');
            $table->integer('year')->nullable()->comment('년');
            $table->string('roadName')->nullable()->comment('도로명');
            $table->string('roadBuildingMainCode')->nullable()->comment('도로명건물본번호코드');
            $table->string('roadBuildingSubCode')->nullable()->comment('도로명건물부번호코드');
            $table->string('roadCityCode')->nullable()->comment('도로명시군구코드');
            $table->string('roadSerialCode')->nullable()->comment('도로명일련번호코드');
            $table->string('roadUpDownCode')->nullable()->comment('도로명지상지하코드');
            $table->string('roadCode')->nullable()->comment('도로명코드');
            $table->string('legalDong')->nullable()->comment('법정동');
            $table->string('legalDongMainNumberCode')->nullable()->comment('법정동본번코드');
            $table->string('legalDongSubNumberCode')->nullable()->comment('법정동부번코드');
            $table->string('legalDongCityCode')->nullable()->comment('법정동시군구코드');
            $table->string('legalDongDistrictCode')->nullable()->comment('법정동읍면동코드');
            $table->string('legalDongCode')->nullable()->comment('법정동지번코드');
            $table->string('aptName')->nullable()->comment('아파트');
            $table->integer('month')->nullable()->comment('월');
            $table->string('day')->nullable()->comment('일');
            $table->string('serialNumber')->nullable()->comment('일련번호');
            $table->float('exclusiveArea')->nullable()->comment('전용면적');
            $table->string('jibun')->nullable()->comment('지번');
            $table->string('regionCode')->nullable()->comment('지역코드');
            $table->integer('floor')->nullable()->comment('층');
            $table->string('unique_code')->unique()->nullable()->comment('유니크 코드 (년.월.일.일련번호.건물명 조합하여 만듬)');
            $table->integer('is_matching')->default(0)->comment('매칭 여부 - 0: 매칭전, 1: 매칭완료');

            //전월세일 경우에만 사용
            $table->string('transactionMonthPrice')->nullable()->comment('월세금액');
            $table->string('renewalRight')->nullable()->comment('갱신요구권사용');
            $table->string('contract_type')->nullable()->comment('계약 구분');
            $table->string('contract_at')->nullable()->comment('계약기간');
            $table->string('previousTransactionPrice')->nullable()->comment('종전계약보증금');
            $table->string('previousTransactionMonthPrice')->nullable()->comment('종전계약월세');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE transactions_apt COMMENT='실거래가 아파트'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('transactions_apt');
    }
};
