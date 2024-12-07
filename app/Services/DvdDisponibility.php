<?php

namespace App\Services;

use App\Enums\Disponibility;
use App\Jobs\DisponibilityManagementJob;
use App\Models\Dvd;

class DvdDisponibility
{
  public function __construct(private readonly Dvd $dvd) {}

  public function checkDvdDisponibility(Dvd $dvd)
  {
    return $dvd->disponibility === Disponibility::AVAILABLE->value();
  }

  public function getDvdStock(Dvd $dvd)
  {
    return $dvd->stock;
  }

  public function whenDvdIsNotAvailableJob(Dvd $dvd)
  {
    $disponibility = $dvd->stock()->first()->quantity > 0;

    if (!$disponibility) {
      DisponibilityManagementJob::dispatch($dvd)->onConnection('redis');
    }
  }
}
