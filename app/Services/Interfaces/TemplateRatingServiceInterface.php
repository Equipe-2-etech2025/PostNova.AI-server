<?php
namespace App\Services\Interfaces;

interface TemplateRatingServiceInterface
{
    /**
     * Récupérer tous les ratings avec éventuellement des filtres
     */
    public function getAllRatings(array $filters = []);

    /**
     * Trouver un rating par ID
     */
    public function getRatingById(int $id);

    /**
     * Créer ou mettre à jour le rating d'un utilisateur pour un template
     */
    public function upsertRating(int $templateId, int $userId, float $rating);

    /**
     * Supprimer un rating
     */
    public function deleteRating(int $id);

    /**
     * Récupérer la moyenne des ratings pour un template
     */
    public function getAverageRating(int $templateId);
}
