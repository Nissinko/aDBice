<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->string('company');

            $table->string('comment', 1000)->nullable();
            $table->string('representative')->nullable();
            $table->string('main_place')->nullable();
            $table->string('branch')->nullable();
            $table->string('sales')->nullable();
            $table->string('abstract', 1000)->nullable();
            $table->string('url')->nullable();
            $table->string('stock_open')->nullable();
            $table->string('inner_ratio')->nullable();
            $table->string('stockholder')->nullable();

            $table->string('company_url');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
