<?php

namespace Tests\Feature\Socials;

use App\Models\Social;
use PHPUnit\Framework\Attributes\Test;

class SocialAuthorizationTest extends BaseSocialTest
{
    #[Test]
    public function only_admin_can_manage_socials()
    {
        $social = Social::factory()->create();

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/socials'],
            ['method' => 'getJson', 'url' => '/api/campaigns/search'],
            ['method' => 'getJson', 'url' => '/api/socials/'.$social->id],
            ['method' => 'postJson', 'url' => '/api/socials', 'data' => $this->validSocialData()],
            ['method' => 'putJson', 'url' => "/api/socials/{$social->id}", 'data' => ['name' => 'Updated']],
            ['method' => 'deleteJson', 'url' => "/api/socials/{$social->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function guest_cannot_access_protected_endpoints()
    {
        $social = Social::factory()->create();

        $protectedEndpoints = [
            ['method' => 'postJson', 'url' => '/api/socials'],
            ['method' => 'putJson', 'url' => "/api/socials/{$social->id}"],
            ['method' => 'deleteJson', 'url' => "/api/socials/{$social->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
