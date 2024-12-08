<?php

namespace App\Services;

use App\Enums\SalesStatus;
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
    $dvdStock = $this->stock::where('dvd_id', $dvd->id)->first();

    $notHasStock = $dvdStock->quantity === 0;

    if ($notHasStock) {
      return response()->json(['message' => 'Dvd not available'], Response::HTTP_BAD_REQUEST);
    }

    $dvdStock->decrement('quantity', 1);

    if ($notHasStock) {
      DisponibilityManagementJob::dispatch($dvd)->onConnection('redis');
    }

    $cart = $this->cart::create([
      'customer_id' => $user->id,
      'dvd_id' => $dvd->id
    ]);

    $sales = $this->sales::create([
      'point_of_sale_id' => $request->point_of_sale_id,
      'seller_id' => $request->seller_id,
      'cart_id' => $cart->id,
      'sold_at' => $request->sold_at ?? now(),
      'status' => $request->status ?? SalesStatus::PENDING->value(),
      'total_amount' => $request->total_amount ?? 0
    ]);

    return response()->json([
      'data' => [
        ['sale' => $sales],
        ['cart' => $cart],
        ['dvd' => $dvd],
        ['user' => $user]
      ]
    ], Response::HTTP_CREATED);
  }
}
