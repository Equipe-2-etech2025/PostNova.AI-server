<?php

namespace Tests\Feature\LandingPage;

use App\Models\LandingPage;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\LandingPage\BaseLandingPageTest;

class LandingPageAuthorizationTest extends BaseLandingPageTest
{
    #[Test]
    public function admin_has_full_access_to_all_landing_page_endpoints()
    {
        $landingPage = LandingPage::factory()->create(['campaign_id' => $this->campaign->id]);

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/landing-pages'],
            ['method' => 'getJson', 'url' => '/api/landing-pages/search'],
            ['method' => 'postJson', 'url' => '/api/landing-pages', 'data' => $this->validLandingPageData()],
            ['method' => 'getJson', 'url' => "/api/landing-pages/{$landingPage->id}"],
            ['method' => 'putJson', 'url' => "/api/landing-pages/{$landingPage->id}", 'data' => ['path' => 'updated-path']],
            ['method' => 'deleteJson', 'url' => "/api/landing-pages/{$landingPage->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function user_can_access_own_campaign_landing_pages()
    {
        $landingPage = LandingPage::factory()->create([
            'campaign_id' => $this->campaign->id,
            'content' => ['title' => 'My Landing Page']
        ]);

        $response = $this->actingAs($this->user)
            ->getJson("/api/landing-pages/{$landingPage->id}");

        $response->assertSuccessful()
            ->assertJsonPath('data.content.title', 'My Landing Page');
    }

    #[Test]
    public function user_cannot_access_other_users_landing_pages()
    {
        $landingPage = LandingPage::factory()->create([
            'campaign_id' => $this->otherCampaign->id
        ]);

        $response = $this->actingAs($this->user)
            ->getJson("/api/landing-pages/{$landingPage->id}");

        $response->assertForbidden();
    }

    #[Test]
    public function guest_cannot_access_protected_landing_page_endpoints()
    {
        $landingPage = LandingPage::factory()->create(['campaign_id' => $this->campaign->id]);

        $response = $this->getJson("/api/landing-pages/{$landingPage->id}");
        $response->assertUnauthorized();
    }

    #[Test]
    public function guest_cannot_access_any_landing_page_endpoints()
    {
        $landingPage = LandingPage::factory()->create(['campaign_id' => $this->campaign->id]);

        $protectedEndpoints = [
            ['method' => 'getJson', 'url' => '/api/landing-pages'],
            ['method' => 'getJson', 'url' => '/api/landing-pages/search'],
            ['method' => 'postJson', 'url' => '/api/landing-pages'],
            ['method' => 'getJson', 'url' => "/api/landing-pages/{$landingPage->id}"],
            ['method' => 'putJson', 'url' => "/api/landing-pages/{$landingPage->id}"],
            ['method' => 'deleteJson', 'url' => "/api/landing-pages/{$landingPage->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }

    #[Test]
    public function user_cannot_create_landing_page_for_other_campaign()
    {
        $data = $this->validLandingPageData($this->otherCampaign->id);

        $response = $this->actingAs($this->user)
            ->postJson('/api/landing-pages', $data);

        $response->assertForbidden();
    }

    #[Test]
    public function user_cannot_update_other_users_landing_pages()
    {
        $landingPage = LandingPage::factory()->create(['campaign_id' => $this->otherCampaign->id]);

        $response = $this->actingAs($this->user)
            ->putJson("/api/landing-pages/{$landingPage->id}", [
                'path' => 'unauthorized-update'
            ]);

        $response->assertForbidden();
    }
}
