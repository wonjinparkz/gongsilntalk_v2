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
        Schema::create('interior_estimate', function (Blueprint $table) {
            $table->id()->comment('인테리어 견적 아이디');
            $table->integer('area')->comment('공급 면적 평');
            $table->integer('users_count')->comment('사용 인원');
            $table->string('place')->comment('입주 예정 지역');
            $table->string('move_date')->comment('입주 예정일');
            $table->string('company_name')->comment('회사명');
            $table->string('company_phone')->comment('연락처');
            $table->string('user_name')->comment('담당자 성함');
            $table->timestamps();

        });

        DB::statement("ALTER TABLE interior_estimate COMMENT='인테리어 견적'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('interior_estimate');
    }
};
