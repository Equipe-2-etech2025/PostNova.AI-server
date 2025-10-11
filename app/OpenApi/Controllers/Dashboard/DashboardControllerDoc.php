<?php

namespace App\OpenApi\Controllers\Dashboard;

/**
 * @OA\Get(
 *     path="/api/dashboard/indicators/{userId}",
 *     summary="Récupérer les indicateurs du dashboard pour un utilisateur",
 *     description="Retourne les statistiques des campagnes et interactions d'un utilisateur, y compris les indicateurs globaux et ceux venant d'autres utilisateurs.",
 *     tags={"Dashboard"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="userId",
 *         in="path",
 *         required=true,
 *         description="Identifiant de l'utilisateur",
 *
 *         @OA\Schema(type="integer", example=45)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Indicateurs récupérés avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="totalCampaigns", type="integer", example=10),
 *                 @OA\Property(property="totalViews", type="integer", example=1200),
 *                 @OA\Property(property="totalLikes", type="integer", example=300),
 *                 @OA\Property(property="totalShares", type="integer", example=75),
 *                 @OA\Property(property="engagementRate", type="number", format="float", example=31.3),
 *                 @OA\Property(
 *                     property="externalInteractions",
 *                     type="object",
 *                     @OA\Property(property="views", type="integer", example=800),
 *                     @OA\Property(property="likes", type="integer", example=150),
 *                     @OA\Property(property="shares", type="integer", example=20)
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Vous devez être connecté pour accéder à cette ressource"),
 *             @OA\Property(property="errors", type="object", example={})
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Vous n'avez pas la permission d'accéder à cette ressource"),
 *             @OA\Property(property="errors", type="object", example={})
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Utilisateur introuvable",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Utilisateur non trouvé"),
 *             @OA\Property(property="errors", type="object", example={})
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Une erreur de serveur est survenue")
 *         )
 *     )
 * )
 */
class DashboardControllerDoc {}
