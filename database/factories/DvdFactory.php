<?php

namespace Database\Factories;

use App\Enums\Disponibility;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

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
        // make a random of movies genre
        $genre = fake()->randomElement(['Ação', 'Aventura', 'Comédia', 'Drama', 'Ficção Científica', 'Romance', 'Terror']);

        return [
            'title' => fake('pt_BR')->word() . ' ' . fake('pt_BR')->word(),
            'genre' => $genre,
            'disponibility' => fake()->numberBetween(1, 2),
            'price' => fake()->randomFloat(2, 0, 100),
            'description' => fake()->text(),
            'image' => 'https://picsum.photos/200',
        ];
    }
}
