<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Companies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PointOfSale>
 */
class PointOfSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'phone' => fake('pt_BR')->phoneNumber(),
            'address_id' => Address::factory()->create(),
            'company_id' => Companies::factory()->create(),
        ];
    }
}
