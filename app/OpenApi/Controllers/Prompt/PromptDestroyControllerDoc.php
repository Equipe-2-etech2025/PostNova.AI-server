<?php

namespace App\OpenApi\Controllers\Prompt;

/**
 * @OA\Delete(
 *     path="/api/prompts/{id}",
 *     summary="Supprimer un prompt",
 *     description="Supprime un prompt spécifique par ID. Seul le propriétaire ou un administrateur peut supprimer un prompt.",
 *     operationId="deletePrompt",
 *     tags={"Prompts"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du prompt à supprimer",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Prompt supprimé avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Prompt supprimé avec succès."),
 *             @OA\Property(property="data", type="object", example={})
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié - Token manquant ou invalide",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Token d'authentification invalide")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé - Pas le propriétaire du prompt",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Vous n'êtes pas autorisé à supprimer ce prompt")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Prompt non trouvé - ID invalide",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Aucun prompt trouvé avec cet ID")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Erreur serveur lors de la suppression")
 *         )
 *     )
 * )
 */
class PromptDestroyControllerDoc {}
