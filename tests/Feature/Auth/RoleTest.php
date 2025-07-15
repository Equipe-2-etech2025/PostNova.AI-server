<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin can access admin routes.
     */
    public function test_admin_can_access_admin_routes(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $token = $admin->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/users');

        $response->assertStatus(200);
    }

    /**
     * Test regular user cannot access admin routes.
     */
    public function test_user_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/users');

        $response->assertStatus(403)
                ->assertJson([
                    'success' => false,
                    'message' => 'Accès non autorisé.',
                ]);
    }

    /**
     * Test role methods on User model.
     */
    public function test_user_role_methods(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        // Test hasRole method
        $this->assertTrue($user->hasRole(User::ROLE_USER));
        $this->assertFalse($user->hasRole(User::ROLE_ADMIN));

        // Test isAdmin method
        $this->assertFalse($user->isAdmin());
        $this->assertTrue($admin->isAdmin());
    }
}
