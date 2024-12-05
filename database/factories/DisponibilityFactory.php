<?php

namespace Database\Factories;

use App\Models\Disponibility;
use App\Http\Enums\Disponibility as DisponibilityEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Disponibility>
 */
class DisponibilityFactory extends Factory
{
    protected $model = Disponibility::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(
                array_map(fn($case) => $case->label(), DisponibilityEnum::cases())
            ),
        ];
    }
}
