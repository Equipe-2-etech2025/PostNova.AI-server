<?php

namespace Tests\Feature\SocialPosts;

use App\Models\Social;
use App\Models\SocialPost;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class SocialPostSearchTest extends BaseSocialPostTest
{
    #[Test]
    public function can_filter_social_posts_by_published_status()
    {
        SocialPost::factory()->create([
            'campaign_id' => $this->campaign->id,
            'is_published' => true,
        ]);

        SocialPost::factory()->create([
            'campaign_id' => $this->campaign->id,
            'is_published' => false,
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/social-posts/search?is_published=true');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.is_published', true);
    }

    #[Test]
    public function can_search_social_posts_by_content()
    {
        SocialPost::factory()->create([
            'campaign_id' => $this->campaign->id,
            'content' => 'Special promotion',
        ]);

        SocialPost::factory()->create([
            'campaign_id' => $this->campaign->id,
            'content' => 'Regular update',
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/social-posts/search?content=promotion');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.content', 'Special promotion');
    }

    #[Test]
    public function search_returns_only_accessible_social_posts_for_user()
    {
        SocialPost::factory()->create(['campaign_id' => $this->campaign->id]);
        SocialPost::factory()->create(['campaign_id' => $this->otherCampaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/social-posts/search');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.campaign_id', $this->campaign->id);
    }

    #[Test]
    public function can_filter_social_posts_by_social_platform()
    {
        $social2 = Social::factory()->create();

        SocialPost::factory()->create([
            'campaign_id' => $this->campaign->id,
            'social_id' => $this->social->id,
        ]);

        SocialPost::factory()->create([
            'campaign_id' => $this->campaign->id,
            'social_id' => $social2->id,
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/social-posts/search?social_id={$this->social->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.social_id', $this->social->id);
    }

    #[Test]
    public function can_combine_multiple_search_filters()
    {

        SocialPost::factory()->create([
            'campaign_id' => $this->campaign->id,
            'social_id' => $this->social->id,
            'is_published' => true,
            'content' => 'Special promotion',

        ]);

        SocialPost::factory()->create([
            'campaign_id' => $this->campaign->id,
            'social_id' => $this->social->id,
            'content' => 'Regular update',
            'is_published' => true,
        ]);

        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/social-posts/search?content=regular&is_published=true&campaign_id={$this->campaign->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.is_published', true);
    }
}
