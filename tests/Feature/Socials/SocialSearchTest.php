<?php

namespace Tests\Feature\Socials;

use App\Models\Social;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class SocialSearchTest extends BaseSocialTest
{
    #[Test]
    public function can_search_socials_by_name()
    {
        Social::factory()->create(['name' => 'Facebook']);
        Social::factory()->create(['name' => 'Twitter']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/socials/search?name=face');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Facebook');
    }

    #[Test]
    public function search_is_case_insensitive()
    {
        Social::factory()->create(['name' => 'INSTAGRAM']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/socials/search?name=instagram');
        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }

    #[Test]
    public function returns_empty_when_no_match()
    {
        Social::factory()->create(['name' => 'LinkedIn']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/socials/search?name=TikTok');
        $response->assertOk()
            ->assertJsonCount(0, 'data');
    }

    #[Test]
    public function can_search_with_partial_name()
    {
        Social::factory()->create(['name' => 'YouTube']);
        Social::factory()->create(['name' => 'You']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/socials/search?name=You');
        $response->assertOk()
            ->assertJsonCount(2, 'data');
    }
}
