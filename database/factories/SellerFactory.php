<?php

namespace Database\Factories;

use App\Models\PointOfSale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'point_of_sale_id' => PointOfSale::factory()->create(),
            'user_id' => User::factory()->create(['role_id' => fake()->numberBetween(2, 3)]),
        ];
    }
}
