<?php

namespace Tests\Feature\CampaignFeatures;

use App\Models\CampaignFeatures;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class CampaignFeaturesCrudOperationsTest extends BaseCampaignFeaturesTest
{
    #[Test]
    public function admin_can_create_campaign_feature_association()
    {
        Sanctum::actingAs($this->admin);
        $response = $this->postJson('/api/campaign-features', $this->validCampaignFeatureData());

        $response->assertCreated();
        $this->assertDatabaseHas('campaign_features', $this->validCampaignFeatureData());
    }

    #[Test]
    public function can_retrieve_single_campaign_feature_association()
    {
        $campaignFeature = CampaignFeatures::create($this->validCampaignFeatureData());
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/campaign-features/{$campaignFeature->id}");

        $response->assertOk()
            ->assertJsonPath('data.campaign_id', $this->campaign->id)
            ->assertJsonPath('data.feature_id', $this->feature->id);
    }

    #[Test]
    public function admin_can_delete_campaign_feature_association()
    {
        $campaignFeature = CampaignFeatures::create($this->validCampaignFeatureData());
        Sanctum::actingAs($this->admin);

        $response = $this->deleteJson("/api/campaign-features/{$campaignFeature->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('campaign_features', ['id' => $campaignFeature->id]);
    }

    #[Test]
    public function can_list_campaign_feature_associations()
    {
        CampaignFeatures::create($this->validCampaignFeatureData());
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/campaign-features');

        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
