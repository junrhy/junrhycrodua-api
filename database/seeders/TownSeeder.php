<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Town;
use File;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Town::truncate();
  
        $json = File::get("database/data/json/towns-ph.json");
        $townsPH = json_decode($json);
  
        foreach ($townsPH as $key => $value) {
            $isCity = isset($value->city) ? ', "city": true' : null;

            Town::create([
                "long_name" => $value->long_name,
                "short_name" => $value->long_name,
                "properties" => sprintf('{ "province": "%s"%s }', $value->province, $isCity)
            ]);
        }
    }
}
