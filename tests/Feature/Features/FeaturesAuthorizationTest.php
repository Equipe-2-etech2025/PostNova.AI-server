<?php

namespace Tests\Feature\Features;

use App\Models\Features;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class FeaturesAuthorizationTest extends BaseFeaturesTest
{
    #[Test]
    public function admin_has_full_access_to_all_features_endpoints()
    {
        $feature = Features::factory()->create();

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/features'],
            ['method' => 'getJson', 'url' => '/api/features/'.$feature->id],
            ['method' => 'postJson', 'url' => '/api/features', 'data' => $this->validFeatureData()],
            ['method' => 'putJson', 'url' => "/api/features/{$feature->id}", 'data' => ['name' => 'Updated']],
            ['method' => 'deleteJson', 'url' => "/api/features/{$feature->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();

        }
    }

    #[Test]
    public function all_users_can_view_features()
    {
        Features::factory()->create();

        Sanctum::actingAs($this->admin);
        $response = $this->getJson('/api/features');
        $response->assertOk();

        Sanctum::actingAs($this->user);
        $response = $this->getJson('/api/features');
        $response->assertOk();
    }

    #[Test]
    public function guest_cannot_access_protected_feature_endpoints()
    {
        $feature = Features::factory()->create();

        $protectedEndpoints = [
            ['method' => 'postJson', 'url' => '/api/features'],
            ['method' => 'putJson', 'url' => "/api/features/{$feature->id}"],
            ['method' => 'deleteJson', 'url' => "/api/features/{$feature->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
