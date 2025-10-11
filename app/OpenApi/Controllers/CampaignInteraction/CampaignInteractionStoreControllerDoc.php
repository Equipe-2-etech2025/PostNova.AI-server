<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

/**
 * @OA\Post(
 *     path="/api/campaign-interactions",
 *     summary="Créer une nouvelle interaction pour une campagne",
 *     description="Crée une interaction (like, view, share, etc.) pour une campagne spécifique.",
 *     tags={"Campaign Interactions"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données de l'interaction à créer",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             required={"campaign_id","user_id","type"},
 *
 *             @OA\Property(property="campaign_id", type="integer", example=12),
 *             @OA\Property(property="user_id", type="integer", example=45),
 *             @OA\Property(property="type", type="string", example="like")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Interaction créée avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/CampaignInteractionResource")
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Requête invalide",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error400")
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
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Les données fournies sont invalides",
 *                 "errors": {
 *                     "type": {"Le champ type doit être 'like', 'view' ou 'share'."}
 *                 }
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500")
 *     )
 * )
 */
class CampaignInteractionStoreControllerDoc {}
