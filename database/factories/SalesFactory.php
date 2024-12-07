<?php

namespace Database\Factories;

use App\Enums\SalesStatus;
use App\Models\Cart;
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
            'point_of_sale_id' => $pointOfSale,
            'seller_id' => Seller::factory()->create(['point_of_sale_id' => $pointOfSale->id]),
            'cart_id' => Cart::factory()->create(),
            'sold_at' => fake()->dateTimeBetween('-8 years', '-1 year'),
            'status' => fake()->randomElement(SalesStatus::cases()),
            'total_amount' => fake()->numberBetween(10000, 50000),
        ];
    }
}
