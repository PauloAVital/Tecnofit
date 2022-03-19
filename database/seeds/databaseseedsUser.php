<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class databaseseedsUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Paulo Vital',
            'email' => 'pauloavital@gmail.com',
            'email_verified_at' => null,
            'password' => '$2y$10$3ZgZEHfhc5bESMWifZFbdeWAvI2uO6zcLS3WsetDi7hkPizh6GRzy'
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Joao',
            'email' => 'joao@gmail.com',
            'email_verified_at' => null,
            'password' => '$2y$10$3ZgZEHfhc5bESMWifZFbdeWAvI2uO6zcLS3WsetDi7hkPizh6GRzy'
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Jose',
            'email' => 'jose@gmail.com',
            'email_verified_at' => null,
            'password' => '$2y$10$3ZgZEHfhc5bESMWifZFbdeWAvI2uO6zcLS3WsetDi7hkPizh6GRzy'
        ]);
    }
}
