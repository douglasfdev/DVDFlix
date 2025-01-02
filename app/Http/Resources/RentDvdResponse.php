<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class RentDvdResponse extends JsonResource
{
    public function __construct($resource, public ?int $statusCode = Response::HTTP_OK)
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;
    }

    /**
     * Remove the timestamps.
     *
     * @param mixed $item
     * @return mixed
     */
    private function removeTimestamps($item)
    {
        if (is_array($item)) {
            unset($item['created_at'], $item['updated_at'], $item['deleted_at']);
        } elseif ($item instanceof \Illuminate\Database\Eloquent\Model) {
            $item = $item->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        }

        return $item;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this->resource;

        $data['sale'] = $this->removeTimestamps($data['sale']);
        $data['cart'] = $this->removeTimestamps($data['cart']);
        $data['dvd'] = $this->removeTimestamps($data['dvd']);
        $data['dvd']['stock'] = $this->removeTimestamps($data['dvd']['stock']);
        $data['user'] = $this->removeTimestamps($data['user']);

        return $data;
    }

    public function toResponse($request)
    {
        return response()->json($this->toArray($request), $this->statusCode);
    }
}
