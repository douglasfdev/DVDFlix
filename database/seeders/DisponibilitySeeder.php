<?php

namespace Database\Seeders;

use App\Models\Disponibility;
use App\Enums\Disponibility as DisponibilityEnum;
use Illuminate\Database\Seeder;

class DisponibilitySeeder extends Seeder
{
  public function run(): void
  {
    foreach (DisponibilityEnum::cases() as $case) {
      Disponibility::factory()->create([
        'status' => $case->label(),
      ]);
    }
  }
}
