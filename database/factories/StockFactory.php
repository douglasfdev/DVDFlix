<?php

namespace Database\Factories;

use App\Models\Dvd;
use App\Models\PointOfSale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(1, 10),
            'dvd_id' => Dvd::factory()->create(),
            'point_of_sale_id' => PointOfSale::factory()->create(),
        ];
    }
}
