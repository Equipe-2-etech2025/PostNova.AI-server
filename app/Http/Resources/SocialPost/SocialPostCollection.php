<?php

namespace App\Http\Resources\SocialPost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SocialPostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'data' => SocialPostResource::collection($this->collection),
            'meta' => [
                'total' => $this->count(),
            ]
        ];
    }
}
