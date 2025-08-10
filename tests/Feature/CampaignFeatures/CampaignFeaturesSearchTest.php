<?php

namespace Tests\Feature\CampaignFeatures;

use App\Models\Campaign;
use App\Models\Features;
use App\Models\CampaignFeatures;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class CampaignFeaturesSearchTest extends BaseCampaignFeaturesTest
{
    #[Test]
    public function can_filter_campaign_features_by_campaign()
    {
        $campaign2 = Campaign::factory()->create();
        CampaignFeatures::create($this->validCampaignFeatureData());
        CampaignFeatures::create([
            'campaign_id' => $campaign2->id,
            'feature_id' => $this->feature->id
        ]);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/campaign-features/search?campaign_id={$this->campaign->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.campaign_id', $this->campaign->id);
    }

    #[Test]
    public function can_filter_campaign_features_by_feature()
    {
        $feature2 = Features::factory()->create();
        CampaignFeatures::create($this->validCampaignFeatureData());
        CampaignFeatures::create([
            'campaign_id' => $this->campaign->id,
            'feature_id' => $feature2->id
        ]);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/campaign-features/search?feature_id={$this->feature->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.feature_id', $this->feature->id);
    }

    #[Test]
    public function can_combine_campaign_and_feature_filters()
    {
        $campaign2 = Campaign::factory()->create();
        $feature2 = Features::factory()->create();

        CampaignFeatures::create($this->validCampaignFeatureData());

        CampaignFeatures::create([
            'campaign_id' => $campaign2->id,
            'feature_id' => $this->feature->id
        ]);
        CampaignFeatures::create([
            'campaign_id' => $this->campaign->id,
            'feature_id' => $feature2->id
        ]);

        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/campaign-features/search?campaign_id={$this->campaign->id}&feature_id={$this->feature->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
