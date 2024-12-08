<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Http\Requests\UserRequest;
use App\Http\Resources\CustomerResponse;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Response;

class CustomerService
{
  public function __construct(
    private readonly User $user,
    private readonly Customer $customer
  ) {}

  public function index()
  {
    return CustomerResponse::collection($this->user->with('customer')->paginate(25));
  }

  public function store(UserRequest $request)
  {
    $customerCreation = $this->user->create($request->validated());
    $customerCreation->role_id = RoleEnum::CUSTOMER->value();
    $customerCreation->save();
    $customerCreation->customer()->create();

    return CustomerResponse::make($customerCreation, Response::HTTP_CREATED);
  }

  public function show(User $user)
  {
    if (!$user) {
      return CustomerResponse::make(null, Response::HTTP_NOT_FOUND);
    }

    $customer = $user->with('customer')->find($user->id);
    if (!$customer) {
      return CustomerResponse::make(null, Response::HTTP_NOT_FOUND);
    }

    return CustomerResponse::make($customer, Response::HTTP_OK);
  }

  public function update(UserRequest $request, User $user)
  {
    if (!$user->with('customer')->find($user->id)) {
      return CustomerResponse::make(null, Response::HTTP_NOT_FOUND);
    }

    $user->update($request->validated());

    return CustomerResponse::make($user->refresh(), Response::HTTP_OK);
  }

  public function destroy(User $user)
  {
    if (!$user) {
      return CustomerResponse::make(null, Response::HTTP_NOT_FOUND);
    };

    $customer = $this->customer::query()->where('user_id', $user->id);

    if (!$customer) {
      return response()->json(['message' => 'Customer not found'], Response::HTTP_NOT_FOUND);
    }

    $customer->delete();

    return CustomerResponse::make(null, Response::HTTP_NO_CONTENT);
  }
}
