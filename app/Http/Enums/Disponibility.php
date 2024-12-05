<?php

namespace App\Http\Enums;

enum Disponibility: int
{
  case UNAVAILABLE = 1;
  case AVAILABLE = 2;

  public static function values(): array
  {
    return [
      self::AVAILABLE->value,
      self::UNAVAILABLE->value,
    ];
  }

  public function value()
  {
    return match ($this) {
      self::AVAILABLE => self::AVAILABLE->value,
      self::UNAVAILABLE => self::UNAVAILABLE->value,
    };
  }

  public function label(): string
  {
    return match ($this) {
      self::AVAILABLE => 'Disponível',
      self::UNAVAILABLE => 'Alugado',
    };
  }
}
