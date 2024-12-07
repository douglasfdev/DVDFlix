<?php

namespace Database\Factories;

use App\Enums\SalesStatus;
use App\Models\Customer;
use App\Models\PointOfSale;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales>
 */
class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pointOfSale = PointOfSale::factory()->create();

        return [
            'seller_id' => Seller::factory()->create(['company_id' => $pointOfSale->id]),
            'customer_id' => Customer::factory()->create(['company_id' => $pointOfSale->id]),
            'sold_at' => fake()->dateTimeBetween('-8 years', '-1 year'),
            'total_amount' => fake()->numberBetween(10000, 50000),
            'status' => fake()->randomElement(SalesStatus::cases())
        ];
    }
}
