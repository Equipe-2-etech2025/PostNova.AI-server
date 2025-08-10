<?php

namespace Tests\Feature\Auth\Campaigns;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Models\TypeCampaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CampaignGuestAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->typeCampaign = TypeCampaign::factory()->create();
    }

    private function validCampaignData(): array
    {
        return [
            'name' => 'Test Campaign',
            'description' => 'Test Description',
            'type_campaign_id' => $this->typeCampaign->id,
            'status' => StatusEnum::Processing->value,
        ];
    }

    #[Test]
    public function guest_cannot_access_any_campaign_route()
    {
        $campaign = Campaign::factory()->create([
            'status' => StatusEnum::Processing->value,
            'type_campaign_id' => $this->typeCampaign->id
        ]);

        $routes = [
            ['method' => 'getJson', 'url' => '/api/campaigns'],
            ['method' => 'getJson', 'url' => '/api/campaigns/search'],
            ['method' => 'postJson', 'url' => '/api/campaigns', 'data' => $this->validCampaignData()],
            ['method' => 'getJson', 'url' => "/api/campaigns/{$campaign->id}"],
            ['method' => 'putJson', 'url' => "/api/campaigns/{$campaign->id}", 'data' => [
                'name' => 'Updated',
                'status' => StatusEnum::Completed->value,
            ]],
            ['method' => 'deleteJson', 'url' => "/api/campaigns/{$campaign->id}"],
        ];

        foreach ($routes as $route) {
            $response = $this->{$route['method']}(
                $route['url'],
                $route['data'] ?? []
            );

            $response->assertUnauthorized();
        }
    }
}
