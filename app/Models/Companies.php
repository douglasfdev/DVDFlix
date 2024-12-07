<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Companies extends Model
{
    /** @use HasFactory<\Database\Factories\CompaniesFactory> */
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'comission_rate',
        'name',
    ];

    public function pointOfSales(): HasMany
    {
        return $this->hasMany(PointOfSale::class);
    }
}
