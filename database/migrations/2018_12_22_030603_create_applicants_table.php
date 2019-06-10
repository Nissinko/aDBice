<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->string('name');
            $table->string('furigana');
            $table->string('gender');
            $table->integer('age');
            $table->string('prefecture');
            $table->string('phone');
            $table->string('company');
            $table->integer('company_num');
            $table->string('education');
            $table->string('job_class');
            $table->string('gyoukai');
            $table->string('salary');
            $table->string('hope_place');
            $table->string('hope_job_class');
            $table->string('hope_gyoukai');
            $table->date('day');
            $table->string('url');

            $table->string('mail')->nullable();
            $table->string('education_detail')->nullable();
            $table->string('skill', 1000)->nullable();
            $table->string('shokumu_abst', 1000)->nullable();
            $table->string('PR', 1000)->nullable();
            $table->string('motivation', 1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
