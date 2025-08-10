<?php

namespace App\Http\Resources\Prompt;

use App\Http\Resources\TarifUser\TarifUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PromptCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => PromptResource::collection($this->collection),
            'meta' => [
                'total' => $this->count(),
            ]
        ];
    }
}
