<?php

namespace App\OpenApi\Controllers\Mvola;

/**
 * @OA\Post(
 *     path="/api/payments",
 *     summary="Effectuer un paiement",
 *     description="Crée un paiement pour un utilisateur et active le tarif correspondant.",
 *     tags={"Payments"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="amount", type="string", example="5000"),
 *             @OA\Property(property="currency", type="string", example="Ar"),
 *             @OA\Property(property="description", type="string", example="Paiement Pro"),
 *             @OA\Property(property="customer_msisdn", type="string", example="0341234567"),
 *             @OA\Property(property="merchant_msisdn", type="string", example="0337654321")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Paiement effectué avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="id", type="integer", example=12),
 *             @OA\Property(property="amount", type="number", format="float", example=5000),
 *             @OA\Property(property="currency", type="string", example="Ar"),
 *             @OA\Property(property="transaction_reference", type="string", example="TRX123456789"),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 15:30:00")
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
 *                 "message": "Vous devez être connecté pour effectuer un paiement."
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
 *                 "message": "Vous n'avez pas la permission d'effectuer ce paiement."
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
 *                 "message": "Utilisateur ou tarif introuvable."
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur lors du paiement",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Payment error: Montant invalide"
 *             }
 *         )
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/payments/user",
 *     summary="Lister les paiements de l'utilisateur connecté",
 *     description="Retourne la liste des paiements effectués par l'utilisateur connecté.",
 *     tags={"Payments"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des paiements de l'utilisateur",
 *
 *         @OA\JsonContent(
 *             type="array",
 *
 *             @OA\Items(
 *
 *                 @OA\Property(property="amount", type="number", format="float", example=5000),
 *                 @OA\Property(property="currency", type="string", example="Ar"),
 *                 @OA\Property(property="transaction_reference", type="string", example="TRX123456789"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 15:30:00")
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
 *                 "message": "Vous devez être connecté pour accéder à vos paiements."
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
 *                 "message": "Vous n'avez pas la permission de consulter ces paiements."
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
 *                 "message": "Aucun paiement trouvé pour cet utilisateur."
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
class PaymentControllerDoc {}
