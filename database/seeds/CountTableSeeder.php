<?php

use Illuminate\Database\Seeder;

class CountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('count')->insert([
            'count'=>0,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }
}
