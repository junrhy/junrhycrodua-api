<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hobby;
use File;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hobby::truncate();
  
        $json = File::get("database/data/json/hobbies.json");
        $hobbies = json_decode($json);
  
        foreach ($hobbies as $key => $value) {
            Hobby::create([
                "name" => $value->name
            ]);
        }
    }
}
