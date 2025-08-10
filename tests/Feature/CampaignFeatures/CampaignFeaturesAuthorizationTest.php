<?php

namespace Tests\Feature\CampaignFeatures;

use App\Models\CampaignFeatures;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class CampaignFeaturesAuthorizationTest extends BaseCampaignFeaturesTest
{
    #[Test]
    public function only_admin_can_manage_campaign_features()
    {
        $campaign = $this->createCampaignForUser($this->user);

        $campaignFeature = CampaignFeatures::create([
            ...$this->validCampaignFeatureData(),
            'campaign_id' => $campaign->id
        ]);

        $otherCampaign = $this->createCampaignForUser($this->user);

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/campaign-features'],
            ['method' => 'getJson', 'url' => '/api/campaign-features/search'],
            ['method' => 'getJson', 'url' => '/api/campaign-features/' . $campaignFeature->id],
            ['method' => 'postJson', 'url' => '/api/campaign-features', 'data' => [...$this->validCampaignFeatureData(), 'campaign_id' => $campaign->id]],
            ['method' => 'putJson', 'url' => "/api/campaign-features/{$campaignFeature->id}", 'data' => [...$this->validCampaignFeatureData(), 'campaign_id' => $otherCampaign->id]],
            ['method' => 'deleteJson', 'url' => "/api/campaign-features/{$campaignFeature->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }
    #[Test]
    public function all_users_can_view_campaign_features()
    {
        CampaignFeatures::create($this->validCampaignFeatureData());

        Sanctum::actingAs($this->admin);
        $response = $this->getJson('/api/campaign-features');
        $response->assertOk();

        Sanctum::actingAs($this->user);
        $response = $this->getJson('/api/campaign-features');
        $response->assertOk();
    }

    #[Test]
    public function guest_cannot_access_protected_endpoints()
    {
        $campaignFeature = CampaignFeatures::create($this->validCampaignFeatureData());

        $protectedEndpoints = [
            ['method' => 'postJson', 'url' => '/api/campaign-features'],
            ['method' => 'deleteJson', 'url' => "/api/campaign-features/{$campaignFeature->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
