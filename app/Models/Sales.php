<?php

namespace App\Models;

use App\Enums\SalesStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    /** @use HasFactory<\Database\Factories\SalesFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'point_of_sale_id',
        'cart_id',
        'seller_id',
        'sold_at',
        'status',
        'total_amount'
    ];

    protected function casts(): array
    {
        return [
            'status' => SalesStatus::class
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
