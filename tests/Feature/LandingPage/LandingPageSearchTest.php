<?php

namespace Tests\Feature\LandingPage;

use App\Models\LandingPage;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class LandingPageSearchTest extends BaseLandingPageTest
{
    #[Test]
    public function can_filter_landing_pages_by_published_status()
    {
        LandingPage::factory()->create([
            'campaign_id' => $this->campaign->id,
            'is_published' => true,
        ]);

        LandingPage::factory()->create([
            'campaign_id' => $this->campaign->id,
            'is_published' => false,
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/landing-pages/search?is_published=false');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.is_published', false);
    }

    #[Test]
    public function can_list_paginated_landing_pages()
    {
        LandingPage::factory()->count(15)->create([
            'campaign_id' => $this->campaign->id,
            'content' => ['title' => 'Landing Page'],
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/landing-pages');
        $response->assertOk()
            ->assertJsonStructure([
                'data',
            ])
            ->assertJsonCount(15, 'data');
    }

    #[Test]
    public function search_returns_only_accessible_landing_pages_for_user()
    {
        LandingPage::factory()->create([
            'campaign_id' => $this->campaign->id,
        ]);

        LandingPage::factory()->create([
            'campaign_id' => $this->otherCampaign->id,
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/landing-pages/search');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.campaign_id', $this->campaign->id);
    }

    #[Test]
    public function can_search_landing_pages_by_path()
    {
        LandingPage::factory()->create([
            'campaign_id' => $this->campaign->id,
            'path' => 'special-offer',
        ]);

        LandingPage::factory()->create([
            'campaign_id' => $this->campaign->id,
            'path' => 'regular-page',
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/landing-pages/search?path=special');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.path', 'special-offer');
    }
}
