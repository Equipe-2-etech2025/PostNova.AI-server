<?php

namespace Tests\Feature\CampaignFeatures;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Features;

abstract class BaseCampaignFeaturesTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;
    protected $campaign;
    protected $feature;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->user = User::factory()->create(['role' => User::ROLE_USER]);

        $this->campaign = Campaign::factory()->create();
        $this->feature = Features::factory()->create();
    }

    protected function validCampaignFeatureData($campaignId = null, $featureId = null): array
    {
        return [
            'campaign_id' => $campaignId ?? $this->campaign->id,
            'feature_id' => $featureId ?? $this->feature->id,
        ];
    }

    protected function createCampaignForUser(User $user, array $overrides = [])
    {
        $defaults = [
            'user_id' => $user->id,
        ];

        return Campaign::factory()->create(array_merge($defaults, $overrides));
    }
}
