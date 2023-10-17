<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Animal;
use File;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Animal::truncate();
  
        $json = File::get("database/data/json/animals.json");
        $animals = json_decode($json);
  
        foreach ($animals as $key => $value) {
            Animal::create([
                "name" => $value->name
            ]);
        }
    }
}
