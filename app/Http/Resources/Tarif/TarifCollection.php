<?php

namespace App\Http\Resources\Tarif;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TarifCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public $collects = TarifResource::class;

    public function toArray(Request $request): array
    {
        return [
            'data' => TarifResource::collection($this->collection),
        ];
    }
}
