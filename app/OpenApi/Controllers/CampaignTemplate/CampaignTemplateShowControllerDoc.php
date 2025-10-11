<?php

namespace App\OpenApi\Controllers\CampaignTemplate;

/**
 * @OA\Get(
 *     path="/api/campaign-templates/{id}",
 *     summary="Récupérer un modèle de campagne spécifique avec stats",
 *     description="Retourne un modèle de campagne avec ses statistiques (rating, nombre d'utilisations).",
 *     tags={"Campaign Templates"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du template de campagne",
 *
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Template récupéré avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/CampaignTemplateResource")
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error401")
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error403")
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Template introuvable",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error400")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500")
 *     )
 * )
 */
class CampaignTemplateShowControllerDoc {}
