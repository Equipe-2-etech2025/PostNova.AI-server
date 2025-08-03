<?php

namespace App\Http\Controllers\API\Image;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\Interfaces\ImageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class ImageDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly ImageServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $image = $this->service->getImageById($id);
        $this->authorize('delete', $image);
        $this->service->deleteImage($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}
