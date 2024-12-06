<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function __construct(private readonly Customer $customer) {}

    public function index(Request $request)
    {
        return CustomerResponse::collection($this->customer->paginate(25));
    }

    public function store(CustomerRequest $request)
    {
        $data = $this->customer->create($request->validated());

        return CustomerResponse::make($data, Response::HTTP_CREATED);
    }

    public function show(Customer $customer)
    {
        return CustomerResponse::make($customer, Response::HTTP_OK);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return CustomerResponse::make($customer->refresh(), Response::HTTP_OK);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return CustomerResponse::make(null, Response::HTTP_NO_CONTENT);
    }
}
