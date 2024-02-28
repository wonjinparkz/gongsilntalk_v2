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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // 계정 인증 정보
            $table->string('provider')->comment('사용자 가입 유형 - email : 이메일, kakao : 카카오톡, naver : 네이버, google: 구글, apple : 애플');
            $table->string('email')->unique()->comment('사용자 이메일');
            $table->string('password')->nullable()->comment('비밀번호');

            // SNS 로그인 정보
            $table->string("token", 100)->nullable()->comment("SNS 회원 토큰 정보");

            // 사용자 정보
            $table->integer('type')->nullable()->comment('회원 타입 - 0 : 일반회원, 1 : 중개사');
            $table->integer("state")->comment("사용자 상태 - 0 : 사용가능, 1: 사용정지, 2: 탈퇴 ");

            $table->string('name')->nullable()->comment('사용자 이름');
            $table->string('nickname')->nullable()->unique()->comment('사용자 닉네임');
            $table->string('phone')->nullable()->unique()->comment('사용자 전화번호');
            $table->integer('gender')->nullable()->comment('사용자 성별 0 : 남자, 1 : 여자');
            $table->string('birth')->nullable()->comment('사용자 생년월일');
            $table->string('unique_key')->nullable()->comment('본인인증 유니크키');

            // 사용자 탈퇴 정보
            $table->string('leave_reason')->nullable()->comment('탈퇴 이유');
            $table->timestamp('leaved_at')->nullable()->comment('탈퇴일');

            // 사용자 기기 정보
            $table->string("device_type", 1)->nullable()->comment("디바이스 종류. 1: Android, 2: IOS, 3: Other");
            $table->string("fcm_key")->nullable()->comment("Google FCM 키");
            $table->integer('is_alarm')->nullable(1)->comment('알림 설정 -  0 : 설정 안함, 1 : 설정');
            $table->integer('is_marketing')->nullable(1)->comment('마케팅 수신 설정 -  0 : 설정 안함, 1 : 설정');
            $table->timestamp('marketing_at')->nullable()->comment('마케팅 동의 시간');

            // 중개사 정보
            $table->integer('company_state')->nullable()->comment('승인 상태 - 0:승인 요청 , 1: 승인, 2:승인 거절');
            $table->string('company_name')->nullable()->comment('중개사무소명');
            $table->string('company_phone')->nullable()->comment('대표 전화번호');
            $table->string('company_ceo')->nullable()->comment('대표자 명');
            $table->string('company_number')->nullable()->comment('사업자 등록번호');
            $table->string('company_postcode')->nullable()->comment('중개소 우편번호');
            $table->string('company_address')->nullable()->comment('중개소 주소');
            $table->string('company_address_detail')->nullable()->comment('중개소 상세 주소');
            $table->longText('refuse_coment')->nullable()->comment('승인거절 사유');
            $table->timestamp('refuse_at')->nullable()->comment('승인 거절일');
            $table->string('brokerage_number')->nullable()->comment('중개등록번호');
            $table->date('opening_date')->nullable()->comment('개업일');

            // 시간 관련
            $table->timestamp('last_used_at')->nullable()->comment("마지막 사용 시간");
            $table->timestamps();
        });
        DB::statement("ALTER TABLE users COMMENT='사용자'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
