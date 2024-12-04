<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(private readonly Customer $customer) {}

    public function index(Request $request)
    {
        return response()->json($this->customer->paginate(25));
    }
}
