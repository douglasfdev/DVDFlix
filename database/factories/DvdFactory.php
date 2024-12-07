<?php

namespace Database\Factories;

use App\Enums\Disponibility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dvd>
 */
class DvdFactory extends Factory
{
    protected $model = \App\Models\Dvd::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'genre' => fake()->name(),
            'disponibility' => fake()->numberBetween(1, 2),
            'price' => fake()->randomFloat(2, 0, 100),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
        ];
    }
}
