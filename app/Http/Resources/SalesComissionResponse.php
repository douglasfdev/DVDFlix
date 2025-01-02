<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesComissionResponse extends JsonResource
{
    public function __construct($resource, public ?int $statusCode = 200)
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'company' => $this->company,
            'point_of_sale' => $this->pointOfSale,
            'seller' => $this->seller,
            'customer' => $this->customer,
            'city' => $this->city,
            'state' => $this->state,
            'sold_at' => $this->soldAt,
            'status' => $this->status,
            'total_amount' => $this->totalAmount,
            'comission' => $this->comission,
        ];
    }

    public function toResponse($request)
    {
        return response()->json($this->toArray($request), $this->statusCode);
    }
}
