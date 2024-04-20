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
            AddressSeeder::class,
            AnimalSeeder::class,
            BarangaySeeder::class,
            BrandSeeder::class,
            ClientSeeder::class,
            CountrySeeder::class,
            InventorySeeder::class,
            ItemSeeder::class,
            PlantSeeder::class,
            ProvinceSeeder::class,
            RealEstateSeeder::class,
            StateSeeder::class,
            TownSeeder::class,
            UserSeeder::class
        ]);
    }
}
