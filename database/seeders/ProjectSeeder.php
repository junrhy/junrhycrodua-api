<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();

        Project::create([
            "id" => "c2bf232d-49c1-4c93-9506-c297bdec99f2",
            "long_name" => "Restaurant Management System",
            "short_name" => "Restaurant"
        ]);

        Project::create([
            "id" => "6899e779-982e-4f2f-8adf-c9b2405aace2",
            "long_name" => "Retail Management System",
            "short_name" => "Retail"
        ]);

        Project::create([
            "id" => "a02bc3a9-77c3-46e0-a97e-b21dea4d9534",
            "long_name" => "Rental Management System",
            "short_name" => "Rental"
        ]);

        Project::create([
            "id" => "98cc39c7-825c-4651-aa04-a9207b9ee7fd",
            "long_name" => "Loan Management System",
            "short_name" => "Loan"
        ]);
    }
}
