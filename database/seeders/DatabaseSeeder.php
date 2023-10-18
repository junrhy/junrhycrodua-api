<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AddressSeeder::class,
            AgentSeeder::class,
            AnimalSeeder::class,
            BarangaySeeder::class,
            BookingSeeder::class,
            BookSeeder::class,
            BrandSeeder::class,
            CampaignSeeder::class,
            CardSeeder::class,
            CategorySeeder::class,
            ContactSeeder::class,
            CountrySeeder::class,
            CourierSeeder::class,
            FamilySeeder::class,
            FeatureSeeder::class,
            FileSeeder::class,
            HobbySeeder::class,
            InventorySeeder::class,
            ItemSeeder::class,
            LeadSeeder::class,
            LoginSeeder::class,
            LogisticSeeder::class,
            MessageSeeder::class,
            PaymentGatewaySeeder::class,
            PaymentSeeder::class,
            PersonSeeder::class,
            PlanSeeder::class,
            PlantSeeder::class,
            ProductSeeder::class,
            ProjectSeeder::class,
            PromotionSeeder::class,
            ProvinceSeeder::class,
            RealEstateSeeder::class,
            SaleSeeder::class,
            ScheduleSeeder::class,
            StateSeeder::class,
            StatusSeeder::class,
            SubscriptionSeeder::class,
            TaxSeeder::class,
            TemplateSeeder::class,
            TownSeeder::class,
            UserSeeder::class,
            VehicleSeeder::class,
            VendorSeeder::class,
            VoucherSeeder::class
        ]);
    }
}
