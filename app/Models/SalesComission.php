<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesComission extends Model
{
    protected $table = "sales_comission_view";
    public $incrementing = false;
    public $timestamps = false;

    public function scopeGetColumns()
    {
        return [
            'company',
            'pointOfSale',
            'seller',
            'customer',
            'city',
            'state',
            'soldAt',
            'status',
            'totalAmount',
            'comission'
        ];
    }
}
