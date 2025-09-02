<?php

namespace Tests\Feature\TarifFeatures;

use App\Models\TarifFeature;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TarifFeatureAuthorizationTest extends BaseTarifFeatureTest
{
    #[Test]
    public function only_admin_has_full_access_to_tarif_feature_endpoints()
    {
        $feature = TarifFeature::factory()->create();

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/tarif-features'],
            ['method' => 'getJson', 'url' => '/api/tarif-features/search'],
            ['method' => 'getJson', 'url' => '/api/tarif-features/'.$feature->id],
            ['method' => 'postJson', 'url' => '/api/tarif-features', 'data' => $this->validTarifFeatureData()],
            ['method' => 'putJson', 'url' => "/api/tarif-features/{$feature->id}", 'data' => ['name' => 'Updated']],
            ['method' => 'deleteJson', 'url' => "/api/tarif-features/{$feature->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function all_users_can_view_tarif_features()
    {
        TarifFeature::factory()->create();

        Sanctum::actingAs($this->admin);
        $response = $this->getJson('/api/tarif-features');
        $response->assertOk();

        Sanctum::actingAs($this->user);
        $response = $this->getJson('/api/tarif-features');
        $response->assertOk();
    }

    #[Test]
    public function guest_cannot_access_protected_tarif_feature_endpoints()
    {
        $feature = TarifFeature::factory()->create();

        $protectedEndpoints = [
            ['method' => 'postJson', 'url' => '/api/tarif-features'],
            ['method' => 'putJson', 'url' => "/api/tarif-features/{$feature->id}"],
            ['method' => 'deleteJson', 'url' => "/api/tarif-features/{$feature->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
