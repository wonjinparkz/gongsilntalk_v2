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
        Schema::create('product_option', function (Blueprint $table) {
            $table->id()->comment('매물 추가정보 아이디');
            $table->integer('product_id')->comment('매물 아이디');
            $table->integer('type')->comment('옵션 항목
            (시설 - 0 : 베란다, 1: 테라스),
            (보안 - 2: 디지털 도어락, 3: 카드키, 4: 무인택배함, 5: 방범창, 6: 비디오폰, 7: 화재감지기, 8: 화재경보기, 9: 소화기, 10: CCTV,  11: 자체경비원, 12: 관리인 상주),
            (주방 - 13: 인덕션, 14: 가스레인지, 15: 전자레인지, 16: 오븐, 17: 식기세척기, 18: 싱크대),
            (가전 - 19: 무선인터넷, 20: 에어컨, 21: 세탁기, 22: 냉장고, 23: 비데, 24:  TV),
            (가구 - 25: 붙박이장, 26: 드레스룸, 27: 신발장, 28: 욕조, 29: 식탁),
            (기타 - 30: 베란다, 31: 테라스, 32: 발코니, 33: 마당)');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE product_option COMMENT='매물 추가정보'");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option');
    }
};
