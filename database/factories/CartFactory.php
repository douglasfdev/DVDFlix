<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Dvd;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory()->create(),
            'dvd_id' => Dvd::factory()->create(),
        ];
    }
}
