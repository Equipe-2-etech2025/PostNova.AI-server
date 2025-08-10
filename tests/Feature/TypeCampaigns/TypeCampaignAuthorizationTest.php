<?php

namespace Tests\Feature\TypeCampaigns;

use App\Models\TypeCampaign;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TypeCampaignAuthorizationTest extends BaseTypeCampaignTest
{
    #[Test]
    public function only_admin_can_manage_type_campaigns()
    {
        $type_campaign = TypeCampaign::factory()->create();

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/type-campaigns'],
            ['method' => 'getJson', 'url' => '/api/type-campaigns/search'],
            ['method' => 'getJson', 'url' => '/api/type-campaigns/' . $type_campaign->id],
            ['method' => 'postJson', 'url' => '/api/type-campaigns', 'data' => $this->validTypeCampaignData()],
            ['method' => 'putJson', 'url' => "/api/type-campaigns/{$type_campaign->id}", 'data' => ['name' => 'Updated']],
            ['method' => 'deleteJson', 'url' => "/api/type-campaigns/{$type_campaign->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function all_users_can_view_type_campaigns()
    {
        TypeCampaign::factory()->create();

        Sanctum::actingAs($this->admin);
        $response = $this->getJson('/api/type-campaigns');
        $response->assertOk();

        Sanctum::actingAs($this->user);
        $response = $this->getJson('/api/type-campaigns');
        $response->assertOk();
    }

    #[Test]
    public function guest_cannot_access_protected_endpoints()
    {
        $type = TypeCampaign::factory()->create();

        $protectedEndpoints = [
            ['method' => 'postJson', 'url' => '/api/type-campaigns'],
            ['method' => 'putJson', 'url' => "/api/type-campaigns/{$type->id}"],
            ['method' => 'deleteJson', 'url' => "/api/type-campaigns/{$type->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
