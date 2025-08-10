<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use PHPUnit\Framework\Attributes\Test;

class ImageAuthorizationTest extends BaseImageTest
{
    #[Test]
    public function admin_has_full_access_to_all_image_endpoints()
    {
        $image = Image::factory()->create(['campaign_id' => $this->campaign->id]);

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/images'],
            ['method' => 'getJson', 'url' => '/api/images/search'],
            ['method' => 'postJson', 'url' => '/api/images', 'data' => $this->validImageData()],
            ['method' => 'getJson', 'url' => "/api/images/{$image->id}"],
            ['method' => 'putJson', 'url' => "/api/images/{$image->id}", 'data' => ['path' => 'updated.jpg']],
            ['method' => 'deleteJson', 'url' => "/api/images/{$image->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function user_can_access_own_campaign_images()
    {
        $image = Image::factory()->create(['campaign_id' => $this->campaign->id]);

        $response = $this->actingAs($this->user)
            ->getJson("/api/images/{$image->id}");

        $response->assertSuccessful();
    }

    #[Test]
    public function user_cannot_access_other_users_images()
    {
        $image = Image::factory()->create(['campaign_id' => $this->otherCampaign->id]);

        $response = $this->actingAs($this->user)
            ->getJson("/api/images/{$image->id}");

        $response->assertForbidden();
    }

    #[Test]
    public function guest_cannot_access_protected_image_endpoints()
    {
        $image = Image::factory()->create(['campaign_id' => $this->campaign->id]);

        $response = $this->getJson("/api/images/{$image->id}");
        $response->assertUnauthorized();
    }

    #[Test]
    public function guest_cannot_access_any_image_endpoints()
    {
        $image = Image::factory()->create(['campaign_id' => $this->campaign->id]);

        $protectedEndpoints = [
            ['method' => 'getJson', 'url' => '/api/images'],
            ['method' => 'getJson', 'url' => '/api/images/search'],
            ['method' => 'postJson', 'url' => '/api/images'],
            ['method' => 'getJson', 'url' => "/api/images/{$image->id}"],
            ['method' => 'putJson', 'url' => "/api/images/{$image->id}"],
            ['method' => 'deleteJson', 'url' => "/api/images/{$image->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
