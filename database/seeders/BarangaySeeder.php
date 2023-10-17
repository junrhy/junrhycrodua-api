<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barangay;
use File;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barangay::truncate();
  
        $json = File::get("database/data/json/barangays-ph.json");
        $barangaysPH = json_decode($json);
  
        foreach ($barangaysPH as $key => $value) {
            Barangay::create([
                "name" => $value->brgyDesc,
                "official_id" => $value->id,
                "brgy_code" => $value->brgyCode,
                "region_code" => $value->regCode,
                "province_code" => $value->provCode,
                "municipal_code" => $value->citymunCode
            ]);
        }
    }
}
