<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

/**
 * @OA\Put(
 *     path="/api/campaign-interactions/{id}",
 *     summary="Mettre à jour une interaction existante",
 *     description="Met à jour les informations d'une interaction spécifique (like, view, share, etc.) d'une campagne.",
 *     tags={"Campaign Interactions"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de l'interaction à mettre à jour",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=101)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données de l'interaction à mettre à jour",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="type", type="string", example="share"),
 *             @OA\Property(property="likes", type="integer", example=2),
 *             @OA\Property(property="views", type="integer", example=15),
 *             @OA\Property(property="shares", type="integer", example=3)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Interaction mise à jour avec succès",
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
 *                     "likes": {"Le nombre de likes doit être un entier positif."}
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
class CampaignInteractionUpdateControllerDoc {}
