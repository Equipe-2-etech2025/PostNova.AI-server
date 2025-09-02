<?php

namespace App\Policies;

use App\Models\SocialPost;
use App\Models\User;

class SocialPostPolicy
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
    public function view(User $user, SocialPost $socialPost): bool
    {
        return $socialPost->campaign->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, SocialPost $socialPost): bool
    {
        return $socialPost->campaign->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SocialPost $socialPost): bool
    {
        return $socialPost->campaign->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SocialPost $socialPost): bool
    {
        return $socialPost->campaign->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SocialPost $socialPost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SocialPost $socialPost): bool
    {
        return false;
    }
}
