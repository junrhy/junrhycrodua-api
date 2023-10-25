<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            "id" => "642e8036-d835-4619-a41f-5fe625fc54ab",
            "long_name" => "Test Client",
            "short_name" => "test-client"
        ]);
    }
}
