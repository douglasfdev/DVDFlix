<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AddressSeeder::class,
            CompaniesSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            DisponibilitySeeder::class,
            DvdSeeder::class,
            CartSeeder::class,
            PointOfSaleSeeder::class,
            SellerSeeder::class,
            StockSeeder::class,
            SalesSeeder::class,
        ]);
    }
}
