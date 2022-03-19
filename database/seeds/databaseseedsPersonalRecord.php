<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class databaseseedsPersonalRecord extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personal_record')->insert([
            'id' => 1,
            'user_id' => 1,
            'movement_id' => 1,
            'value' => 100.0,
            'date' => '2021-01-01 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 2,
            'user_id' => 1,
            'movement_id' => 1,
            'value' => 180.0,
            'date' => '2021-01-02 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 3,
            'user_id' => 1,
            'movement_id' => 1,
            'value' => 150.0,
            'date' => '2021-01-03 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 4,
            'user_id' => 1,
            'movement_id' => 1,
            'value' => 110.0,
            'date' => '2021-01-04 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 5,
            'user_id' => 2,
            'movement_id' => 1,
            'value' => 110.0,
            'date' => '2021-01-04 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 6,
            'user_id' => 2,
            'movement_id' => 1,
            'value' => 140.0,
            'date' => '2021-01-05 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 7,
            'user_id' => 2,
            'movement_id' => 1,
            'value' => 190.0,
            'date' => '2021-01-06 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 8,
            'user_id' => 3,
            'movement_id' => 1,
            'value' => 170.0,
            'date' => '2021-01-01 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 9,
            'user_id' => 3,
            'movement_id' => 1,
            'value' => 120.0,
            'date' => '2021-01-02 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 10,
            'user_id' => 3,
            'movement_id' => 1,
            'value' => 130.0,
            'date' => '2021-01-03 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 11,
            'user_id' => 1,
            'movement_id' => 2,
            'value' => 130.0,
            'date' => '2021-01-03 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 12,
            'user_id' => 2,
            'movement_id' => 2,
            'value' => 130.0,
            'date' => '2021-01-03 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 13,
            'user_id' => 3,
            'movement_id' => 2,
            'value' => 125.0,
            'date' => '2021-01-03 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 14,
            'user_id' => 1,
            'movement_id' => 2,
            'value' => 110.0,
            'date' => '2021-01-05 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 15,
            'user_id' => 1,
            'movement_id' => 2,
            'value' => 100.0,
            'date' => '2021-01-01 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 16,
            'user_id' => 2,
            'movement_id' => 2,
            'value' => 120.0,
            'date' => '2021-01-01 00:00:00.0'            
        ]);

        DB::table('personal_record')->insert([
            'id' => 17,
            'user_id' => 3,
            'movement_id' => 2,
            'value' => 120.0,
            'date' => '2021-01-01 00:00:00.0'            
        ]);
    }
}
