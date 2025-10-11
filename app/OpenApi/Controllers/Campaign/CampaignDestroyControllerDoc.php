<?php

namespace App\OpenApi\Controllers\Campaign;

/**
 * @OA\Delete(
 *     path="/api/campaigns/{id}",
 *     summary="Supprimer une campagne",
 *     description="Supprime une campagne existante appartenant à l’utilisateur connecté (ou accessible par un admin).",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la campagne à supprimer",
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Campagne supprimée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="message", type="string", example="Supprimé avec succès.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Requête invalide",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "La requête est invalide",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error403"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès interdit",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error403"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error500"
 *         )
 *     )
 * )
 */
class CampaignDestroyControllerDoc {}
