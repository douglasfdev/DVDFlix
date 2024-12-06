<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function __construct(private readonly Customer $customer) {}

    public function index(Request $request)
    {
        return response()->json($this->customer->paginate(25));
    }

    public function store(CustomerRequest $request)
    {
        return response()->json($this->customer->create($request->validated()));
    }

    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->customer->update($request->validated());

        return response()->json($this->customer->find($customer->id));
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
