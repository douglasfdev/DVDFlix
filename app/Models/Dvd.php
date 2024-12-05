<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
