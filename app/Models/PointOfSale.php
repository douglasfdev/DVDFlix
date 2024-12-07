<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointOfSale extends Model
{
    /** @use HasFactory<\Database\Factories\PointOfSaleFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'commission_rate',
        'name'
    ];

    public function sellers(): HasMany
    {
        return $this->hasMany(Seller::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
