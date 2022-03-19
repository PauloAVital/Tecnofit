<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(databaseseedsUser::class);
        $this->call(databaseseedsMoviment::class);
        $this->call(databaseseedsPersonalRecord::class);
    }
}

