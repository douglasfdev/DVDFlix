<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointOfSale extends Model
{
    /** @use HasFactory<\Database\Factories\PointOfSaleFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address_id',
        'phone',
        'company_id',
    ];

    public function sellers(): HasMany
    {
        return $this->hasMany(Seller::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Companies::class);
    }
}
