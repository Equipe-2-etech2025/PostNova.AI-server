<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Auth\AuthenticationException;

class UserService implements UserServiceInterface
{
    public function changePassword(int $userId, string $currentPassword, string $newPassword): bool
    {
        $user = User::findOrFail($userId);

        if (!Hash::check($currentPassword, $user->password)) {
            throw new AuthenticationException('Le mot de passe actuel est incorrect.');
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return true;
    }
}
