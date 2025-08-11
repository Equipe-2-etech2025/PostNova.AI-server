<?php

namespace Tests\Feature\LandingPage;

use App\Models\LandingPage;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class LandingPageCrudOperationsTest extends BaseLandingPageTest
{
    #[Test]
    public function test_can_create_landing_page_with_valid_data()
    {
        Sanctum::actingAs($this->user);

        $response = $this->postJson('/api/landing-pages', $this->validLandingPageData());

        $response->assertStatus(201);

        $this->assertDatabaseHas('landing_pages', [
            'path' => 'test/path/landing-page',
            'campaign_id' => $this->campaign->id,
        ]);
    }

    #[Test]
    public function can_retrieve_single_landing_page()
    {
        $landingPage = LandingPage::factory()->create([
            'campaign_id' => $this->campaign->id,
            'content' => ['title' => 'Test Page'],
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/landing-pages/{$landingPage->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $landingPage->id)
            ->assertJsonPath('data.content.title', 'Test Page');
    }

    #[Test]
    public function can_update_existing_landing_page()
    {
        $landingPage = LandingPage::factory()->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $updateData = [
            'path' => 'updated/path',
        ];

        $response = $this->putJson("/api/landing-pages/{$landingPage->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('landing_pages', array_merge(
            ['id' => $landingPage->id],
            $updateData
        ));
    }

    #[Test]
    public function can_delete_landing_page()
    {
        $landingPage = LandingPage::factory()->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->deleteJson("/api/landing-pages/{$landingPage->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('landing_pages', ['id' => $landingPage->id]);
    }

    #[Test]
    public function can_search_landing_pages()
    {
        $landingPage = LandingPage::factory()->create([
            'campaign_id' => $this->campaign->id,
            'path' => 'special-offer.com',
            'content' => ['type' => 'special-offer'],
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/landing-pages/search?path=special');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.path', 'special-offer.com');
    }

    #[Test]
    public function can_list_landing_pages()
    {
        LandingPage::factory(3)->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/landing-pages');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
