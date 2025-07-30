<?php

namespace App\Policies;

use App\Models\Features;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FeaturesPolicy
{
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
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
    public function view(User $user, Features $features): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Features $features): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Features $features): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Features $features): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Features $features): bool
    {
        return false;
    }
}
