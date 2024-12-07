<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    HasMany
};

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'dvd_id',
    ];

    public function dvds(): HasMany
    {
        return $this->hasMany(Dvd::class);
    }

    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
