<?php

use Database\Seeders\BloodSeeder;
use Database\Seeders\NationalitySeeder;
use Database\Seeders\ReligionSeeder;
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
        $this->call(
            [
                BloodSeeder::class,
                NationalitySeeder::class,
                ReligionSeeder::class
            ]
        );
    }
}
