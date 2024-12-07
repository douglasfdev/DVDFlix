<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Http\Resources\CustomerResponse;
use App\Models\Customer;
use Illuminate\Http\Response;

class CustomerService
{
  public function __construct(private readonly Customer $customer) {}

  public function index()
  {
    return CustomerResponse::collection($this->customer->paginate(25));
  }

  public function store(UserRequest $request)
  {
    $data = $this->customer->create($request->validated());

    return CustomerResponse::make($data, Response::HTTP_CREATED);
  }

  public function show(Customer $customer)
  {
    return CustomerResponse::make($customer, Response::HTTP_OK);
  }

  public function update(UserRequest $request, Customer $customer)
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
