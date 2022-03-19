<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class databaseseedsMoviment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movement')->insert([
            'id' => 1,
            'name' => 'Deadlift'
        ]);

        DB::table('movement')->insert([
            'id' => 2,
            'name' => 'Back Squat'
        ]);

        DB::table('movement')->insert([
            'id' => 3,
            'name' => 'Bench Press'
        ]);
    }
}
