<?php

namespace Tests\Feature\Campaigns;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Models\TypeCampaign;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class CampaignSearchTest extends BaseCampaignTest
{
    #[Test]
    public function can_filter_campaigns_by_type()
    {
        $typeCampaign1 = TypeCampaign::factory()->create();
        $typeCampaign2 = TypeCampaign::factory()->create();

        $campaign1 = $this->createCampaignForUser($this->user, [
            'type_campaign_id' => $typeCampaign1->id,
        ]);

        $campaign2 = $this->createCampaignForUser($this->user, [
            'type_campaign_id' => $typeCampaign2->id,
        ]);

        $this->assertEquals($typeCampaign1->id, $campaign1->fresh()->type_campaign_id);
        $this->assertEquals($typeCampaign2->id, $campaign2->fresh()->type_campaign_id);

        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/campaigns/search?type_campaign_id={$typeCampaign1->id}");

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.type_campaign_id', $typeCampaign1->id)
            ->assertJsonPath('data.0.id', $campaign1->id);
    }

    #[Test]
    public function can_search_campaigns_by_name()
    {
        $this->createCampaignForUser($this->user, ['name' => 'Summer Sale']);
        $this->createCampaignForUser($this->user, ['name' => 'Winter Promotion']);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/campaigns/search?name=Summer');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Summer Sale');
    }

    #[Test]
    public function can_list_paginated_campaigns()
    {
        for ($i = 0; $i < 15; $i++) {
            $this->createCampaignForUser($this->user);
        }

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/campaigns');

        $response->assertOk()
            ->assertJsonStructure([
                'data',
            ]);
    }

    #[Test]
    public function admin_can_search_all_campaigns()
    {
        $this->createCampaignForUser($this->user);
        $this->createCampaignForUser($this->otherUser);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/campaigns/search');

        $response->assertOk()
            ->assertJsonCount(2, 'data');
    }

    #[Test]
    public function can_search_with_multiple_filters()
    {
        $this->assertCount(0, Campaign::all());

        $type_campaign = TypeCampaign::factory()->create();

        $matchingCampaign = $this->createCampaignForUser($this->user, [
            'name' => 'Summer Sale',
            'type_campaign_id' => $type_campaign->id,
            'status' => StatusEnum::Created->value,
        ]);

        $this->createCampaignForUser($this->user, [
            'name' => 'Summer Day',
            'type_campaign_id' => $type_campaign->id,
            'status' => StatusEnum::Failed->value,
        ]);

        $this->createCampaignForUser($this->user, [
            'name' => 'Summer Close',
            'type_campaign_id' => $type_campaign->id,
        ]);

        Sanctum::actingAs($this->user);
        $response = $this->getJson('/api/campaigns/search?'.http_build_query([
            'name' => 'Summer',
            'type_campaign_id' => $type_campaign->id,
            'status' => StatusEnum::Created->label(),
        ]));

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Summer Sale')
            ->assertJsonPath('data.0.type_campaign_id', $type_campaign->id)
            ->assertJsonPath('data.0.status.label', 'created')
            ->assertJsonPath('data.0.status.value', StatusEnum::Created->value);
    }
}
