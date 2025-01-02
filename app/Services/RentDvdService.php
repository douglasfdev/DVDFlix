<?php

namespace App\Services;

use App\Enums\SalesStatus;
use App\Http\Resources\RentDvdResponse;
use App\Jobs\DisponibilityManagementJob;
use App\Models\{
  Cart,
  Dvd,
  Sales,
  Stock,
  User,
};
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentDvdService
{
  public function __construct(
    private readonly Stock $stock,
    private readonly Cart $cart,
    private readonly Sales $sales
  ) {}

  public function customerRentedDvd(User $user, Dvd $dvd, Request $request)
  {
    $dvdStock = $dvd->stock ?? null;

    if ($dvdStock?->quantity === null) {
      return response()->json(['message' => 'Dvd not available'], Response::HTTP_BAD_REQUEST);
    }

    if ($dvdStock?->quantity === null || $dvdStock?->quantity === 0) {
      return response()->json(['message' => 'Dvd not available'], Response::HTTP_BAD_REQUEST);
    }

    $dvdStock->decrement('quantity', 1);

    if ($dvdStock?->quantity <= 0) {
      DisponibilityManagementJob::dispatch($dvd)->onConnection('redis');
    }

    $carts = $this->cart::create([
      'customer_id' => $user->id,
      'dvd_id' => $dvd->id
    ]);

    $sales = $this->sales::create([
      'point_of_sale_id' => $request->point_of_sale_id,
      'seller_id' => $request->seller_id,
      'cart_id' => $carts->id,
      'sold_at' => $request->sold_at ?? now(),
      'status' => $request->status ?? SalesStatus::PENDING->value(),
      'total_amount' => $request->total_amount ?? 0
    ]);

    return RentDvdResponse::make([
      'sale' => $sales,
      'cart' => $carts,
      'dvd' => $dvd,
      'user' => $user
    ], Response::HTTP_CREATED);
  }
}
