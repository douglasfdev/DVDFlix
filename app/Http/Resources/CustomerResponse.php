<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResponse extends JsonResource
{
    public function __construct($resource, public ?int $statusCode = 200)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone ?? '',
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('customers.show', $this->id ?? '')
                ],
                [
                    'rel' => 'patch',
                    'href' => route('customers.update', $this->id ?? '')
                ],
                [
                    'rel' => 'delete',
                    'href' => route('customers.destroy', $this->id ?? '')
                ],
            ]
        ];
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode($this->statusCode)->header('Accept', 'application/json');
    }
}
