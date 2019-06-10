<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->string('company'); # 企業名
            $table->string('gyoukai'); # 業種分類
            $table->string('job_class', 1000); # 職種分類
            $table->string('title'); # 求人内容
            $table->string('necessary', 1000); # 必要なスキル・経験
            $table->float('salary_low'); # 最低給与
            $table->float('salary_high'); # 最大給与
            $table->string('contents', 1000); # 仕事内容
            $table->string('workplace'); # 勤務地
            $table->string('url');
            $table->date('day');

            $table->string('employment_status')->nullable(); # 雇用形態
            $table->string('recommendation', 1000)->nullable(); # 歓迎スキル
            $table->string('test_term')->nullable(); # 試用期間
            $table->string('salary_detail', 1000)->nullable(); # 賃金詳細
            $table->string('working_time')->nullable(); # 就業時間
            $table->string('overtime')->nullable(); # 残業
            $table->string('overtime_pay', 1000)->nullable(); # 残業手当
            $table->string('insurance', 1000)->nullable(); # 社会保険
            $table->string('welfare', 1000)->nullable(); # 福利厚生
            $table->string('holiday', 1000)->nullable(); # 休日
            $table->string('selection_contents', 1000)->nullable(); # 選考内容

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job');
    }
}
