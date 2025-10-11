<?php

namespace App\OpenApi\Controllers\CampaignTemplate;

/**
 * @OA\Get(
 *     path="/api/categories",
 *     summary="Récupérer la liste des catégories",
 *     description="Retourne toutes les catégories disponibles avec leurs icônes.",
 *     tags={"Campaign Templates"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des catégories récupérée avec succès",
 *
 *         @OA\JsonContent(
 *             type="array",
 *
 *             @OA\Items(
 *                 type="object",
 *
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                     example="Marketing",
 *                     description="Nom de la catégorie"
 *                 ),
 *                 @OA\Property(
 *                     property="icon",
 *                     type="string",
 *                     example="marketing-icon",
 *                     description="Nom ou chemin de l'icône"
 *                 )
 *             )
 *         )
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
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500")
 *     )
 * )
 */
class CategoryControllerDoc {}
