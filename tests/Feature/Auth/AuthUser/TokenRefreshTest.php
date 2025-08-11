<?php

namespace Tests\Feature\Auth\AuthUser;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TokenRefreshTest extends TestCase
{
    #[Test]
    public function user_can_refresh_their_token()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->postJson('/api/auth/refresh');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['token', 'token_type'],
            ]);
    }
}
