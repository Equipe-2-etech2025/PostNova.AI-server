<?php

namespace Tests\Feature\Auth\Role;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_can_access_admin_routes()
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $token = $admin->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/users');

        $response->assertStatus(200);
    }

    #[Test]
    public function regular_user_cannot_access_admin_routes()
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
}
