<?php

namespace Tests\Feature\SocialPosts;

use App\Models\SocialPost;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class SocialPostAuthorizationTest extends BaseSocialPostTest
{
    #[Test]
    public function admin_has_full_access_to_all_social_post_endpoints()
    {
        $socialPost = SocialPost::factory()->create(['campaign_id' => $this->campaign->id]);

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/social-posts'],
            ['method' => 'getJson', 'url' => '/api/social-posts/search'],
            ['method' => 'postJson', 'url' => '/api/social-posts', 'data' => $this->validSocialPostData()],
            ['method' => 'getJson', 'url' => "/api/social-posts/{$socialPost->id}"],
            ['method' => 'putJson', 'url' => "/api/social-posts/{$socialPost->id}", 'data' => ['content' => 'Updated']],
            ['method' => 'deleteJson', 'url' => "/api/social-posts/{$socialPost->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function user_can_access_own_campaign_social_posts()
    {
        $socialPost = SocialPost::factory()->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/social-posts/{$socialPost->id}");
        $response->assertSuccessful();
    }

    #[Test]
    public function user_cannot_access_other_users_social_posts()
    {
        $socialPost = SocialPost::factory()->create(['campaign_id' => $this->otherCampaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/social-posts/{$socialPost->id}");
        $response->assertForbidden();
    }

    #[Test]
    public function guest_cannot_access_protected_social_post_endpoints()
    {
        $socialPost = SocialPost::factory()->create(['campaign_id' => $this->campaign->id]);

        $protectedEndpoints = [
            ['method' => 'getJson', 'url' => '/api/social-posts'],
            ['method' => 'getJson', 'url' => '/api/social-posts/search'],
            ['method' => 'postJson', 'url' => '/api/social-posts'],
            ['method' => 'getJson', 'url' => "/api/social-posts/{$socialPost->id}"],
            ['method' => 'putJson', 'url' => "/api/social-posts/{$socialPost->id}"],
            ['method' => 'deleteJson', 'url' => "/api/social-posts/{$socialPost->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
