<?php

namespace Tests\Feature\Auth\Role;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    #[Test]
    public function it_correctly_identifies_user_roles()
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $this->assertTrue($user->hasRole(User::ROLE_USER));
        $this->assertFalse($user->hasRole(User::ROLE_ADMIN));

        $this->assertFalse($user->isAdmin());
        $this->assertTrue($admin->isAdmin());
    }

    #[Test]
    public function it_can_check_multiple_roles()
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
