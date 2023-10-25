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
            "project_id" => "c2bf232d-49c1-4c93-9506-c297bdec99f2",
            "long_name" => "Restaurant Test Brand",
            "short_name" => "restaurant-test-brand"
        ]);

        Brand::create([
            "id" => "ca4202d5-53c1-4d33-bc75-44a8e29bdb37",
            "project_id" => "6899e779-982e-4f2f-8adf-c9b2405aace2",
            "long_name" => "Retail Test Brand",
            "short_name" => "retail-test-brand"
        ]);

        Brand::create([
            "id" => "1116124e-7324-4221-9905-a65b003c6a06",
            "project_id" => "a02bc3a9-77c3-46e0-a97e-b21dea4d9534",
            "long_name" => "Rental Test Brand",
            "short_name" => "rental-test-brand"
        ]);

        Brand::create([
            "id" => "581dcb97-3d52-4eb2-adca-798e97073f4f",
            "project_id" => "98cc39c7-825c-4651-aa04-a9207b9ee7fd",
            "long_name" => "Loan Test Brand",
            "short_name" => "loan-test-brand"
        ]);
    }
}
