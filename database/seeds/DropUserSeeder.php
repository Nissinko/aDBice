<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;


class DropUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::dropIfExists('users');
    }
}
