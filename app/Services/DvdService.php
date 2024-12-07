<?php

namespace App\Services;

use App\Enums\Disponibility as DisponibilityEnum;
use App\Http\Requests\DvdRequest;
use App\Http\Resources\DvdResponse;
use App\Models\Dvd;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DvdService
{
  public function __construct(private readonly Dvd $dvd) {}

  public function index()
  {
    return DvdResponse::collection(
      $this->dvd->where(
        'disponibility',
        '!=',
        DisponibilityEnum::UNAVAILABLE->value()
      )->paginate(25)
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(DvdRequest $request)
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
  public function show(Dvd $dvd)
  {
    $dvd = $dvd->newQuery()
      ->where('id', $dvd->id)
      ->where('disponibility', '!=', DisponibilityEnum::UNAVAILABLE->value())
      ->first();

    if (!$dvd) {
      return response()->json(['message' => 'Dvd not found'], Response::HTTP_NOT_FOUND);
    }

    return DvdResponse::make($dvd, Response::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(DvdRequest $request, Dvd $dvd)
  {
    $dvd->update($request->validated());

    return DvdResponse::make($dvd->fresh(), Response::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Dvd $dvd)
  {
    $dvd->delete();

    return DvdResponse::make(null, Response::HTTP_NO_CONTENT);
  }
}
