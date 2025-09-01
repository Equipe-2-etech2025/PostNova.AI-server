<?php

namespace App\Http\Controllers\API\Image;

use App\Http\Controllers\Controller;
use App\Services\Image\ImageCreateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageGenerationController extends Controller
{
    public function __construct(
        private readonly ImageCreateService $imageService
    ) {}

    public function generateImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prompt' => 'required|string|min:10|max:1000',
            'campaign_id' => 'required|integer|exists:campaigns,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $imageData = $this->imageService->generateAndCreateImage($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Image générée avec succès',
                'images' => [$imageData], // Wrapper dans un tableau pour correspondre au frontend
                'data' => [
                    'image' => $imageData,
                    'image_url' => $imageData['url']
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la génération de l\'image',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getModelInfo()
    {
        return response()->json([
            'success' => true,
            'data' => $this->imageService->getModelInfo()
        ]);
    }
}