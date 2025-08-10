<?php

namespace Tests\Feature\Prompts;

use App\Models\Prompt;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class PromptSearchTest extends BasePromptTest
{
    #[Test]
    public function can_search_prompts_by_content()
    {
        Prompt::factory()->create([
            'campaign_id' => $this->campaign->id,
            'content' => 'Summer promotion prompt'
        ]);

        Prompt::factory()->create([
            'campaign_id' => $this->campaign->id,
            'content' => 'Winter collection prompt'
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/prompts/search?content=promotion');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.content', 'Summer promotion prompt');
    }

    #[Test]
    public function can_filter_prompts_by_campaign()
    {
        Prompt::factory()->create($this->validPromptData($this->campaign->id));
        Prompt::factory()->create($this->validPromptData($this->otherCampaign->id));
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/prompts/search?campaign_id={$this->campaign->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.campaign_id', $this->campaign->id);
    }

    #[Test]
    public function search_returns_only_accessible_prompts_for_user()
    {
        Prompt::factory()->create($this->validPromptData($this->campaign->id));
        Prompt::factory()->create($this->validPromptData($this->otherCampaign->id));
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/prompts/search');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.campaign_id', $this->campaign->id);
    }
}
