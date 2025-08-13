<?php

namespace Tests\Feature\Auth\AuthUser;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProtectedRoutesTest extends TestCase
{
    #[Test]
    public function authenticated_user_can_access_protected_route()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->getJson('/api/auth/me');

        $response->assertStatus(200)
            ->assertJson(['data' => ['id' => $user->id]]);
    }

    #[Test]
    public function unauthenticated_user_cannot_access_protected_route()
    {
        $response = $this->getJson('/api/auth/me');
        $response->assertStatus(401);
    }
}
