<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plant;
use File;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plant::truncate();
  
        $json = File::get("database/data/json/plants.json");
        $plants = json_decode($json);
  
        foreach ($plants as $key => $value) {
            Plant::create([
                "name" => $value->name,
                "properties" => sprintf('{ "species": "%s" }', $value->species)
            ]);
        }
    }
}
