<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;
use File;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::truncate();
  
        $json = File::get("database/data/json/provinces-ph.json");
        $provincesPH = json_decode($json);
  
        foreach ($provincesPH as $key => $value) {
            Province::create([
                "long_name" => $value->long_name,
                "short_name" => $value->short_name,
                "properties" => sprintf('{ "region": "%s" }', $value->region)
            ]);
        }
    }
}
