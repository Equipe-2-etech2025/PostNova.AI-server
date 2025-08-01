<?php

namespace App\Http\Resources\Tarif;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TarifResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'max_limit' => $this->max_limit,
        ];
    }
}
