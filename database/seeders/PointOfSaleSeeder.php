<?php

namespace Database\Seeders;

use App\Models\PointOfSale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointOfSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PointOfSale::factory(10)->create();
    }
}
