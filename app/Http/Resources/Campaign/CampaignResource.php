<?php

namespace App\Http\Resources\Campaign;

use App\Enums\StatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Campaign
 */
class CampaignResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'user_id' => $this->resource->user_id,
            'type_campaign_id' => $this->resource->type_campaign_id,
            'status' => [
                'value' => $this->resource->status,
                'label' => StatusEnum::from($this->resource->status)->label(),
            ],
            'is_published' => $this->is_published,
            'description' => $this->resource->description,

            'user' => $this->when($this->resource->user, function () {
                return [
                    'id' => $this->resource->user->id,
                    'name' => $this->resource->user->name,
                ];
            }),

            'user_has_liked' => $this->when((bool) $request->user(), function () use ($request) {
                return $this->resource->interactions()
                    ->where('user_id', $request->user()->id)
                    ->where('likes', '>', 0)
                    ->exists();
            }, false),
            'user_has_shared' => $this->when((bool) $request->user(), function () use ($request) {

                return $this->resource->interactions()
                    ->where('user_id', $request->user()->id)
                    ->where('shares', '>', 0)
                    ->exists();
            }, false),

            'type' => $this->whenLoaded('typeCampaign', function () {
                return $this->resource->typeCampaign ? [
                    'id' => $this->resource->typeCampaign->id,
                    'name' => $this->resource->typeCampaign->name,
                ] : null;
            }),

            'dates' => [
                'created_at' => $this->resource->created_at ? $this->created_at->format('Y-m-d H:i') : null,
                'updated_at' => $this->resource->updated_at ? $this->updated_at->format('Y-m-d H:i') : null,
                'time_ago' => $this->resource->created_at ? $this->created_at->diffForHumans() : null,
            ],

            'images_count' => $this->resource->images_count ?? 0,
            'landing_pages_count' => $this->resource->landing_pages_count ?? 0,
            'social_posts_count' => $this->resource->social_posts_count ?? 0,

            'total_views' => $this->resource->total_views ?? 0,
            'total_likes' => $this->resource->total_likes ?? 0,
            'total_shares' => $this->resource->total_shares ?? 0,

            'images' => $this->whenLoaded('images', function () {
                return $this->resource->images->map(function ($image) {
                    return [
                        'id' => $image->id,
                        'url' => $image->path,
                        'alt' => 'Image de la campagne',
                        'is_published' => $image->is_published,
                        'created_at' => $image->created_at ? $image->created_at->format('Y-m-d H:i') : null,
                    ];
                });
            }, []),
        ];
    }
}
