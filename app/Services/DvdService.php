<?php

namespace App\Services;

use App\Enums\Disponibility as DisponibilityEnum;
use App\Http\Requests\DvdRequest;
use App\Http\Resources\DvdResponse;
use App\Models\Dvd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DvdService
{
  public function __construct(private readonly Dvd $dvd) {}

  public function index(): AnonymousResourceCollection
  {
    return DvdResponse::collection(
      $this->dvd->with('stock')->where(
        'disponibility',
        '!=',
        DisponibilityEnum::UNAVAILABLE->value()
      )->paginate(24)
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(DvdRequest $request): DvdResponse
  {
    $dvd = $this->dvd->create($request->validated());
    if (!$request->has('disponibility')) {
      $dvd->disponibility = DisponibilityEnum::AVAILABLE->value();
      $dvd->save();
    }

    return DvdResponse::make($dvd, Response::HTTP_CREATED);
  }

  /**
   * Display the specified resource.
   */
  public function show(Dvd $dvd): DvdResponse|JsonResponse
  {
    $dvd = $dvd->newQuery()
      ->where('id', $dvd->id)
      ->with('stock')
      ->first();

    if (!$dvd) {
      return response()->json(['message' => 'Dvd not found'], Response::HTTP_NOT_FOUND);
    }


    return DvdResponse::make($dvd, Response::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(DvdRequest $request, Dvd $dvd): DvdResponse
  {
    $dvd->update($request->validated());

    if (!$request->has('disponibility')) {
      $dvd->disponibility = DisponibilityEnum::AVAILABLE->value();
      $dvd->save();
    }

    if ($request->has('quantity')) {
      $dvd->stock()->update(['quantity' => $request->quantity]);
    }

    return DvdResponse::make($dvd->fresh(), Response::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Dvd $dvd): DvdResponse
  {
    $dvd->delete();
    $dvd->stock()->delete();

    return DvdResponse::make(null, Response::HTTP_NO_CONTENT);
  }
}
