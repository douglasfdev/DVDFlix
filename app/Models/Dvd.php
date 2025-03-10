<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    HasMany,
    HasOne
};

class Dvd extends Model
{
    /** @use HasFactory<\Database\Factories\DvdFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'genre',
        'disponibility',
        'price',
        'description',
        'image',
    ];

    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class, 'dvd_id', 'id');
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
