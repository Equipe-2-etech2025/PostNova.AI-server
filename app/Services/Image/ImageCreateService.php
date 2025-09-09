<?php

namespace App\Services\Image;

use App\DTOs\Image\ImageDto;
use App\Repositories\ImageRepository;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImageCreateService
{
    private const DEFAULT_MODEL = 'stable-diffusion-xl';

    private const MODEL_ID = 'stabilityai/stable-diffusion-xl-base-1.0';

    public function __construct(
        private readonly ImageRepository $imageRepository,
        private readonly CloudinaryService $cloudinaryService
    ) {}

    /**
     * Génère et crée directement l'image en base
     */
    public function generateAndCreateImage(array $params): array
    {
        $generatedImage = $this->generateImage($params);

        // Si la génération a échoué, retourner l'erreur
        if (isset($generatedImage['error'])) {
            throw new \RuntimeException($generatedImage['error']);
        }

        $dto = new ImageDto(
            null,
            path: $generatedImage['path'], // URL Cloudinary stockée en base
            campaign_id: $params['campaign_id'],
            prompt_id: $params['prompt_id'],
            is_published: $params['is_published'] ?? false
        );

        $createdImage = $this->imageRepository->create($dto);

        // Retourner un tableau avec l'URL Cloudinary
        return [
            'id' => $createdImage->id,
            'path' => $createdImage->path,
            'campaign_id' => $createdImage->campaign_id,
            'is_published' => $createdImage->is_published,
            'created_at' => $createdImage->created_at,
            'updated_at' => $createdImage->updated_at,
            'url' => $createdImage->path,
            'prompt' => $generatedImage['prompt'],
            'enhanced_prompt' => $generatedImage['enhanced_prompt'] ?? null,
            'model_used' => $generatedImage['model_used'] ?? self::DEFAULT_MODEL,
        ];
    }

    /**
     * Génère une seule image (sans l'enregistrer)
     */
    public function generateImage(array $params): array
    {
        try {
            return $this->generateSingleImage(
                $params['prompt'],
                $params['campaign_id']
            );
        } catch (\Exception $e) {
            Log::error('Failed to generate image', [
                'error' => $e->getMessage(),
                'prompt' => $params['prompt'],
            ]);

            return [
                'path' => null,
                'prompt' => $params['prompt'],
                'campaign_id' => $params['campaign_id'],
                'error' => $e->getMessage(),
            ];
        }
    }

    private function generateSingleImage(string $prompt, int $campaignId): array
    {
        $enhancedPrompt = $this->enhancePrompt($prompt);

        Log::info('Envoi requête à Hugging Face', [
            'prompt' => $enhancedPrompt,
            'model' => self::MODEL_ID,
        ]);

        $response = Http::retry(3, 1000)
            ->timeout(300)
            ->withHeaders([
                'Authorization' => 'Bearer '.config('services.huggingface.api_key'),
            ])
            ->post('https://api-inference.huggingface.co/models/'.self::MODEL_ID, [
                'inputs' => $enhancedPrompt,
                'parameters' => [
                    'num_inference_steps' => 20,
                    'guidance_scale' => 7.5,
                    'width' => 1024,
                    'height' => 1024,
                ],
                'options' => [
                    'wait_for_model' => true,
                    'use_cache' => false,
                ],
            ]);

        $statusCode = $response->status();
        $contentType = $response->header('Content-Type');

        Log::info('Réponse Hugging Face', [
            'status' => $statusCode,
            'content_type' => $contentType,
            'headers' => $response->headers(),
        ]);

        // Gestion des erreurs HTTP
        if ($statusCode !== 200) {
            $errorData = $response->json();

            if ($statusCode === 503 && isset($errorData['estimated_time'])) {
                throw new \RuntimeException('Modèle en cours de chargement. Réessayez dans '.$errorData['estimated_time'].' secondes');
            }

            if ($statusCode === 429) {
                throw new \RuntimeException('Limite de requêtes dépassée. Veuillez patienter.');
            }

            throw new \RuntimeException("Erreur API ($statusCode): ".$response->body());
        }

        // Vérifier le type de contenu
        if (str_contains($contentType, 'image')) {
            // Réponse directe en image binaire
            $imageData = $response->body();
        } elseif ($contentType === 'application/json') {
            // Réponse JSON - analyser la structure
            $responseData = $response->json();

            if (isset($responseData['error'])) {
                throw new \RuntimeException('Erreur Hugging Face: '.$responseData['error']);
            }

            if (isset($responseData[0]['generated_image'])) {
                // Format avec generated_image en base64
                $imageData = base64_decode($responseData[0]['generated_image']);
            } elseif (isset($responseData[0]['image'])) {
                // Format alternatif avec image en base64
                $imageData = base64_decode($responseData[0]['image']);
            } elseif (isset($responseData['image'])) {
                // Format avec image à la racine
                $imageData = base64_decode($responseData['image']);
            } else {
                // Log de debug pour voir la structure
                Log::error('Format de réponse JSON inattendu', ['response' => $responseData]);
                throw new \RuntimeException('Format de réponse JSON non supporté');
            }
        } else {
            throw new \RuntimeException("Type de contenu non supporté: $contentType");
        }

        // Vérifier que les données image ne sont pas vides
        if (empty($imageData)) {
            throw new \RuntimeException('Aucune donnée image reçue');
        }

        // Sauvegarder l'image sur Cloudinary au lieu du stockage local
        $uploadResult = $this->cloudinaryService->uploadImage(
            $imageData,
            'ai-images/campaign_'.$campaignId,
            'campaign_'.$campaignId.'_'.time()
        );

        if (! $uploadResult['success']) {
            throw new \RuntimeException('Échec de l\'upload Cloudinary: '.$uploadResult['error']);
        }

        return [
            'path' => $uploadResult['url'],
            'prompt' => $prompt,
            'enhanced_prompt' => $enhancedPrompt,
            'campaign_id' => $campaignId,
            'model_used' => self::DEFAULT_MODEL,
            'cloudinary_public_id' => $uploadResult['public_id'],
        ];
    }

    private function enhancePrompt(string $prompt): string
    {
        $qualityKeywords = [
            'high quality', 'professional', 'detailed', 'sharp focus',
            'masterpiece', 'best quality', 'ultra detailed', '4k',
            'photorealistic', 'cinematic lighting', 'studio quality',
        ];

        return $prompt.', '.implode(', ', $qualityKeywords);
    }

    /**
     * Retourne le modèle utilisé
     */
    public function getModelInfo(): array
    {
        return [
            'model' => self::DEFAULT_MODEL,
            'model_id' => self::MODEL_ID,
            'image_size' => '1024x1024',
        ];
    }
}
