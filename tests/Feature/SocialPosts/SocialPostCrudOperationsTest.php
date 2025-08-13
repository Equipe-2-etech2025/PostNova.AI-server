<?php

namespace Tests\Feature\SocialPosts;

use App\Models\SocialPost;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class SocialPostCrudOperationsTest extends BaseSocialPostTest
{
    #[Test]
    public function can_create_social_post_with_valid_data()
    {
        Sanctum::actingAs($this->user);

        $response = $this->postJson('/api/social-posts', $this->validSocialPostData());

        $response->assertCreated();
        $this->assertDatabaseHas('social_posts', $this->validSocialPostData());
    }

    #[Test]
    public function can_retrieve_single_social_post()
    {
        $socialPost = SocialPost::factory()->create([
            'campaign_id' => $this->campaign->id,
            'content' => 'Test content',
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/social-posts/{$socialPost->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $socialPost->id)
            ->assertJsonPath('data.content', 'Test content');
    }

    #[Test]
    public function can_update_existing_social_post()
    {
        $socialPost = SocialPost::factory()->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $updateData = [
            'content' => 'Updated content',
            'is_published' => true,
        ];

        $response = $this->putJson("/api/social-posts/{$socialPost->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('social_posts', array_merge(
            ['id' => $socialPost->id],
            $updateData
        ));
    }

    #[Test]
    public function can_delete_social_post()
    {
        $socialPost = SocialPost::factory()->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->deleteJson("/api/social-posts/{$socialPost->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('social_posts', ['id' => $socialPost->id]);
    }

    #[Test]
    public function can_list_social_posts()
    {
        SocialPost::factory(3)->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/social-posts');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
