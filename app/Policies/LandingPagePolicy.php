<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\LandingPage;
use App\Models\User;

class LandingPagePolicy
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
    public function viewAny(User $user, LandingPage $landingPage): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LandingPage $landingPage): bool
    {
        return $landingPage->campaign->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, int $campaignId)
    {
        $campaign = Campaign::find($campaignId);

        return $campaign && $campaign->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LandingPage $landingPage): bool
    {
        return $landingPage->campaign->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LandingPage $landingPage): bool
    {
        return $landingPage->campaign->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LandingPage $landingPage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LandingPage $landingPage): bool
    {
        return false;
    }
}
