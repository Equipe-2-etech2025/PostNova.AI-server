<?php

namespace App\OpenApi\Controllers\LandingPage;

/**
 * @OA\Put(
 *     path="/api/landing-pages/{id}",
 *     summary="Mettre à jour une landing page",
 *     description="Met à jour le contenu d'une landing page spécifique.",
 *     tags={"LandingPages"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la landing page à mettre à jour",
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             type="object",
 *             required={"content"},
 *
 *             @OA\Property(
 *                 property="content",
 *                 type="object",
 *                 example={"title": "Nouvelle landing page", "sections": {"header": "Bienvenue", "footer": "Contactez-nous"}}
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Landing page mise à jour avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Landing page mise à jour avec succès"),
 *             @OA\Property(property="data", ref="#/components/schemas/LandingPageResource")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Vous devez être connecté pour accéder à cette ressource.")
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
 *             @OA\Property(property="message", type="string", example="Vous n’avez pas la permission de modifier cette landing page.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Landing page non trouvée",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="La landing page demandée est introuvable.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Les données fournies sont invalides."),
 *             @OA\Property(property="errors", type="object",
 *                 example={"content": {"Le champ content est obligatoire."}}
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Une erreur inattendue est survenue lors de la mise à jour de la landing page.")
 *         )
 *     )
 * )
 */
class LandingPageUpadeControllerDoc {}
