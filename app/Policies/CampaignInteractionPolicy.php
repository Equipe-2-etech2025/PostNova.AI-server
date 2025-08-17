<?php

namespace App\Policies;

use App\Models\CampaignInteraction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CampaignInteractionPolicy
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
    public function view(User $user, CampaignInteraction $campaignInteraction): bool
    {
        return $user->id === $campaignInteraction->user_id ||
            $user->id === $campaignInteraction->campaign->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->exists;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CampaignInteraction $campaignInteraction): bool
    {
        return $user->id === $campaignInteraction->user_id;;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CampaignInteraction $campaignInteraction): bool
    {
        return $user->id === $campaignInteraction->user_id ||
               $user->id === $campaignInteraction->campaign->user_id;
    }

    // Méthodes supplémentaires spécifiques aux interactions
    public function like(User $user, CampaignInteraction $interaction): bool
    {
        // L'utilisateur ne peut liker que s'il n'est pas le créateur de la campagne
        return $user->id !== $interaction->campaign->user_id;
    }

    public function report(User $user, CampaignInteraction $interaction): bool
    {
        // Tout utilisateur peut signaler sauf le créateur de l'interaction
        return $user->id !== $interaction->user_id;
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CampaignInteraction $campaignInteraction): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CampaignInteraction $campaignInteraction): bool
    {
        return false;
    }
}
