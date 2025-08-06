<?php

namespace App\Policies;

use App\Models\TarifUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TarifUserPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TarifUser $tarifUser)
    {
        return $user->id === $tarifUser->user_id;
    }

    public function viewLatest(User $user, TarifUser $tarifUser)
    {
        return $user->id === $tarifUser->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TarifUser $tarifUser): bool
    {
        return $user->id === $tarifUser->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TarifUser $tarifUser): bool
    {
        return $user->id === $tarifUser->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TarifUser $tarifUser): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TarifUser $tarifUser): bool
    {
        return false;
    }
}
