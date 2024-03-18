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
        // 댓글 신고
        Schema::create('reply_report', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('사용자 아이디');
            $table->integer('reply_id')->comment('댓글 아이디');
            $table->integer('type')->comment('신고 유형 - 0: 욕설/비방/차별/혐오, 1:광고/홍보/영리목적, 2:불법정보, 3:음란/청소년 유해, 4:개인정보 노출/유포 5:도배/스팸, 6:기타 ');
            $table->string('reason')->comment('신고 사유');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE reply_report COMMENT='댓글 신고'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply_report');
    }
};
