<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            AnimalSeeder::class,
            BarangaySeeder::class,
            CountrySeeder::class,
            PlantSeeder::class,
            ProvinceSeeder::class,
            StateSeeder::class,
            TownSeeder::class
        ]);
    }
}
