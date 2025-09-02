<?php

namespace App\Services\Interfaces;

interface UserServiceInterface
{
    public function changePassword(int $userId, string $currentPassword, string $newPassword): bool;
}
