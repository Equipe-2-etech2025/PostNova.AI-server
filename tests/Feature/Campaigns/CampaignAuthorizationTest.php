<?php

namespace Tests\Feature\Campaigns;

use App\Models\User;
use App\Enums\StatusEnum;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Campaigns\BaseCampaignTest;

class CampaignAuthorizationTest extends BaseCampaignTest
{
    #[Test]
    public function admin_has_full_access_to_all_campaign_endpoints()
    {
        $campaign = $this->createCampaignForUser($this->user);
        $otherUser = User::factory()->create();

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/campaigns'],
            ['method' => 'getJson', 'url' => '/api/campaigns/search'],
            ['method' => 'postJson', 'url' => '/api/campaigns', 'data' => $this->validCampaignData()],
            ['method' => 'getJson', 'url' => "/api/campaigns/{$campaign->id}"],
            ['method' => 'putJson', 'url' => "/api/campaigns/{$campaign->id}", 'data' => ['name' => 'Updated']],
            ['method' => 'deleteJson', 'url' => "/api/campaigns/{$campaign->id}"],
            ['method' => 'getJson', 'url' => "/api/campaigns/user/{$otherUser->id}"],
            ['method' => 'getJson', 'url' => "/api/campaigns/type/{$this->typeCampaign->id}"],
            ['method' => 'getJson', 'url' => '/api/campaigns/popular/content'],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function user_can_access_own_campaigns()
    {
        $campaign = $this->createCampaignForUser($this->user);

        $endpoints = [
            ['method' => 'getJson', 'url' => "/api/campaigns/{$campaign->id}"],
            ['method' => 'putJson', 'url' => "/api/campaigns/{$campaign->id}", 'data' => ['name' => 'Updated']],
            ['method' => 'deleteJson', 'url' => "/api/campaigns/{$campaign->id}"],
            ['method' => 'getJson', 'url' => "/api/campaigns/user/{$this->user->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->user)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function user_cannot_access_other_users_campaigns()
    {
        $otherUserCampaign = $this->createCampaignForUser($this->otherUser);

        $endpoints = [
            ['method' => 'getJson', 'url' => "/api/campaigns/{$otherUserCampaign->id}"],
            ['method' => 'putJson', 'url' => "/api/campaigns/{$otherUserCampaign->id}", 'data' => ['name' => 'Updated']],
            ['method' => 'deleteJson', 'url' => "/api/campaigns/{$otherUserCampaign->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->user)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertForbidden();
        }
    }

    #[Test]
    public function user_can_only_view_own_campaigns()
    {
        $ownCampaign = $this->createCampaignForUser($this->user);

        $otherUserCampaign = $this->createCampaignForUser($this->otherUser);

        Sanctum::actingAs($this->user);

        $responseOwn = $this->getJson("/api/campaigns/{$ownCampaign->id}");
        $responseOwn->assertSuccessful();

        $responseOther = $this->getJson("/api/campaigns/{$otherUserCampaign->id}");
        $responseOther->assertForbidden();
    }

    #[Test]
    public function admin_can_view_all_campaigns()
    {
        $userCampaign = $this->createCampaignForUser($this->user);
        $otherUserCampaign = $this->createCampaignForUser($this->otherUser);

        Sanctum::actingAs($this->admin);

        $responseUser = $this->getJson("/api/campaigns/{$userCampaign->id}");
        $responseUser->assertSuccessful();

        $responseOther = $this->getJson("/api/campaigns/{$otherUserCampaign->id}");
        $responseOther->assertSuccessful();
    }

    #[Test]
    public function guest_cannot_access_any_campaign_endpoints()
    {
        $campaign = $this->createCampaignForUser($this->user, ['status' => StatusEnum::Created->value]);

        $protectedEndpoints = [
            ['method' => 'getJson', 'url' => '/api/campaigns'],
            ['method' => 'postJson', 'url' => '/api/campaigns'],
            ['method' => 'getJson', 'url' => "/api/campaigns/{$campaign->id}"],
            ['method' => 'putJson', 'url' => "/api/campaigns/{$campaign->id}"],
            ['method' => 'deleteJson', 'url' => "/api/campaigns/{$campaign->id}"],
            ['method' => 'getJson', 'url' => "/api/campaigns/user/{$this->user->id}"],
            ['method' => 'getJson', 'url' => '/api/campaigns/popular/content'],
            ['method' => 'getJson', 'url' => '/api/campaigns/search'],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
