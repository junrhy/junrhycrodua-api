<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::truncate();

        Brand::create([
            "id" => "f6f2202a-6d82-11ee-91c0-0242ac120005",
            "long_name" => "junrhycrodua",
            "short_name" => "junrhycrodua"
        ]);
    }
}
