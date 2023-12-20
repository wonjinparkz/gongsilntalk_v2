<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// 커뮤니티 테이블
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 커뮤니티 신고
        Schema::create('community_report', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('사용자 아이디');
            $table->integer('community_id')->comment('커뮤니티 아이디');
            $table->integer('type')->comment('신고 유형 - 0: 게시판 성격에 부적절함, 1:욕설/비하, 2:음란물/불건전한 만남 및 대화, 3:상업적 광고 및 판매, 4:유출/사칭/사기 5:기타 ');
            $table->string('reason')->comment('신고 이유');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE community_report COMMENT='커뮤니티 신고'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_report');
    }
};
