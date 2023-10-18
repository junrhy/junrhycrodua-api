<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            "name" => "Administrator",
            "email" => "admin@junrhycrodua.com",
            "password" => bcrypt("password"),
            "brand_id" => "f6f2202a-6d82-11ee-91c0-0242ac120005"
        ]);
    }
}
