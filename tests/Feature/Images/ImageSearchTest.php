<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class ImageSearchTest extends BaseImageTest
{
    #[Test]
    public function can_filter_images_by_published_status()
    {
        Image::factory()->create([
            'campaign_id' => $this->campaign->id,
            'is_published' => true,
        ]);

        Image::factory()->create([
            'campaign_id' => $this->campaign->id,
            'is_published' => false,
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/images/search?is_published=false');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.is_published', false);
    }

    #[Test]
    public function can_list_paginated_images()
    {
        Image::factory()->count(15)->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/images');
        $response->assertOk()
            ->assertJsonStructure([
                'data',
            ]);
    }

    #[Test]
    public function search_returns_only_accessible_images_for_user()
    {
        Image::factory()->create(['campaign_id' => $this->campaign->id]);
        Image::factory()->create(['campaign_id' => $this->otherCampaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/images/search');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.campaign_id', $this->campaign->id);
    }
}
