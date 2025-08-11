<?php

namespace Tests\Feature\Campaigns;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Models\TypeCampaign;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class CampaignCrudOperationsTest extends BaseCampaignTest
{
    #[Test]
    public function can_create_campaign_with_valid_data()
    {
        Sanctum::actingAs($this->user);

        $data = $this->validCampaignData();

        $response = $this->postJson('/api/campaigns', $data);

        $response->assertCreated();
        $this->assertDatabaseHas('campaigns', $data);
    }

    #[Test]
    public function can_retrieve_single_campaign()
    {
        $campaign = $this->createCampaignForUser($this->user);
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/campaigns/{$campaign->id}");

        dump($response->json());
        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'status' => ['value', 'label'],
                    'description',
                    'dates' => ['created_at', 'updated_at'],
                    'images_count',
                    'landing_pages_count',
                    'social_posts_count',
                    'total_views',
                    'total_likes',
                    'total_shares'
                ]
            ])
            ->assertJson([
                'data' => [
                    'id' => $campaign->id,
                    'name' => $campaign->name,
                    'status' => [
                        'value' => $campaign->status,
                        'label' => StatusEnum::from($campaign->status)->label()
                    ],
                    'description' => $campaign->description
                ]
            ]);
    }

    #[Test]
    public function can_update_existing_campaign()
    {
        $campaign = $this->createCampaignForUser($this->user);
        Sanctum::actingAs($this->user);

        $updateData = [
            'name' => 'Updated Campaign Name',
            'description' => 'Updated description',
            'status' => StatusEnum::Processing->value
        ];

        $response = $this->putJson("/api/campaigns/{$campaign->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('campaigns', array_merge(['id' => $campaign->id], $updateData));
    }

    #[Test]
    public function can_delete_campaign()
    {
        $campaign = $this->createCampaignForUser($this->user);
        Sanctum::actingAs($this->user);

        $response = $this->deleteJson("/api/campaigns/{$campaign->id}");
        $response->assertOk();
        $this->assertDatabaseMissing('campaigns', ['id' => $campaign->id]);
    }

    #[Test]
    public function can_list_user_campaigns()
    {
        $this->createCampaignForUser($this->user);
        $this->createCampaignForUser($this->user);
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/campaigns/user/{$this->user->id}");

        $response->assertOk()
            ->assertJsonCount(2, 'data');
    }

    #[Test]
    public function can_list_campaigns_by_type()
    {
        $type = TypeCampaign::factory()->create();
        $this->createCampaignForUser($this->user, ['type_campaign_id' => $type->id]);
        $this->createCampaignForUser($this->user, ['type_campaign_id' => $type->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/campaigns/type/{$type->id}");

        $response->assertOk()
            ->assertJsonCount(2, 'data');
    }

    #[Test]
    public function can_search_campaigns()
    {
        $campaign1 = $this->createCampaignForUser($this->user, ['name' => 'summer']);
        $campaign2 = $this->createCampaignForUser($this->user, ['name' => 'Winter Promotion']);
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/campaigns/search?name=summer');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'status' => ['value', 'label'],
                        'description',
                        'dates' => ['created_at', 'updated_at'],
                        'images_count',
                        'landing_pages_count',
                        'social_posts_count',
                        'total_views',
                        'total_likes',
                        'total_shares'
                    ]
                ]
            ])
            ->assertJsonCount(1, 'data')
            ->assertJson(['data' => [['id' => $campaign1->id]]])
            ->assertJsonMissing(['data' => [['id' => $campaign2->id]]]);
    }

    #[Test]
    public function can_get_popular_campaigns()
    {
        $this->createCampaignForUser($this->user);
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/campaigns/popular/content');

        $response->assertOk();
    }
}
