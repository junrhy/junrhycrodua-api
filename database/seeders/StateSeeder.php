<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use File;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::truncate();
  
        $json = File::get("database/data/json/states-us.json");
        $states = json_decode($json);
  
        foreach ($states as $key => $value) {
            State::create([
                "country_code" => $value->country_code,
                "long_name" => $value->long_name,
                "short_name" => $value->short_name,
            ]);
        }
    }
}
