<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\CustomerResponse;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function __construct(private readonly User $user) {}

    public function index()
    {
        return CustomerResponse::collection($this->user->paginate(25));
    }

    public function store(UserRequest $request)
    {
        $customerCreation = $this->user->create($request->validated());

        $customerCreation->customer()->create();

        return CustomerResponse::make($customerCreation, Response::HTTP_CREATED);
    }

    public function show(User $customer)
    {
        return CustomerResponse::make($customer, Response::HTTP_OK);
    }

    public function update(UserRequest $request, User $customer)
    {
        $customer->update($request->validated());

        return CustomerResponse::make($customer->refresh(), Response::HTTP_OK);
    }

    public function destroy(User $customer)
    {
        $customer->delete();

        return CustomerResponse::make(null, Response::HTTP_NO_CONTENT);
    }
}
