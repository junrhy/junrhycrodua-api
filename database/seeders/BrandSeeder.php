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
            "client_id" => "642e8036-d835-4619-a41f-5fe625fc54ab",
            "long_name" => "Restaurant Test Brand",
            "short_name" => "restaurant-test-brand"
        ]);

        Brand::create([
            "id" => "ca4202d5-53c1-4d33-bc75-44a8e29bdb37",
            "client_id" => "642e8036-d835-4619-a41f-5fe625fc54ab",
            "long_name" => "Retail Test Brand",
            "short_name" => "retail-test-brand"
        ]);

        Brand::create([
            "id" => "1116124e-7324-4221-9905-a65b003c6a06",
            "client_id" => "642e8036-d835-4619-a41f-5fe625fc54ab",
            "long_name" => "Rental Test Brand",
            "short_name" => "rental-test-brand"
        ]);

        Brand::create([
            "id" => "581dcb97-3d52-4eb2-adca-798e97073f4f",
            "client_id" => "642e8036-d835-4619-a41f-5fe625fc54ab",
            "long_name" => "Loan Test Brand",
            "short_name" => "loan-test-brand"
        ]);
    }
}
