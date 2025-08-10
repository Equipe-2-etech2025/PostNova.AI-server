<?php

namespace Tests\Feature\Prompts;

use App\Models\Prompt;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class PromptAuthorizationTest extends BasePromptTest
{
    #[Test]
    public function admin_has_full_access_to_all_prompt_endpoints()
    {
        $prompt = Prompt::factory()->create($this->validPromptData());

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/prompts'],
            ['method' => 'getJson', 'url' => '/api/prompts/search'],
            ['method' => 'postJson', 'url' => '/api/prompts', 'data' => $this->validPromptData()],
            ['method' => 'getJson', 'url' => "/api/prompts/{$prompt->id}"],
            ['method' => 'putJson', 'url' => "/api/prompts/{$prompt->id}", 'data' => ['content' => 'Admin updated']],
            ['method' => 'deleteJson', 'url' => "/api/prompts/{$prompt->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function user_can_access_own_campaign_prompts()
    {
        $prompt = Prompt::factory()->create($this->validPromptData());
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/prompts/{$prompt->id}");
        $response->assertSuccessful();
    }

    #[Test]
    public function user_cannot_access_other_users_prompts()
    {
        $prompt = Prompt::factory()->create($this->validPromptData($this->otherCampaign->id));
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/prompts/{$prompt->id}");
        $response->assertForbidden();
    }

    #[Test]
    public function guest_cannot_access_protected_prompt_endpoints()
    {
        $prompt = Prompt::factory()->create($this->validPromptData());

        $protectedEndpoints = [
            ['method' => 'getJson', 'url' => '/api/prompts'],
            ['method' => 'getJson', 'url' => '/api/prompts/search'],
            ['method' => 'postJson', 'url' => '/api/prompts'],
            ['method' => 'getJson', 'url' => "/api/prompts/{$prompt->id}"],
            ['method' => 'putJson', 'url' => "/api/prompts/{$prompt->id}"],
            ['method' => 'deleteJson', 'url' => "/api/prompts/{$prompt->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
