<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disponibility extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'disponibility_enumerator';

  protected $fillable = [
    'status',
  ];

  protected function casts(): array
  {
    return [
      Disponibility::class
    ];
  }

  public function dvds(): HasMany
  {
    return $this->hasMany(Dvd::class);
  }
}
