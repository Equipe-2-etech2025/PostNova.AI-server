<?php

namespace App\OpenApi\Controllers\Mvola;

/**
 * @OA\Get(
 *     path="/api/admin/payments",
 *     summary="Lister tous les paiements",
 *     description="Retourne la liste de tous les paiements avec les informations utilisateur et transaction.",
 *     tags={"Payments"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des paiements",
 *
 *         @OA\JsonContent(
 *             type="array",
 *
 *             @OA\Items(
 *
 *                 @OA\Property(property="id", type="integer", example=12),
 *                 @OA\Property(property="username", type="string", example="John Doe"),
 *                 @OA\Property(property="amount", type="number", format="float", example=5000),
 *                 @OA\Property(property="currency", type="string", example="Ar"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 15:30:00"),
 *                 @OA\Property(property="expiration_date", type="string", format="date-time", example="2025-10-25 15:30:00"),
 *                 @OA\Property(property="transaction_reference", type="string", example="TRX123456789")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Vous devez être connecté pour accéder à cette ressource."
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Vous n'avez pas la permission d'accéder à ces paiements."
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Ressource non trouvée",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Aucun paiement trouvé."
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Erreur serveur interne"
 *             }
 *         )
 *     )
 * )
 */
class AdminPaymentControllerDoc {}
