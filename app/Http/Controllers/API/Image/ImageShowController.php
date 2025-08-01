<?php

namespace App\Http\Controllers\API\Image;

use App\Http\Controllers\Controller;
use App\Http\Resources\Image\ImageResource;
use App\Models\Image;
use App\Services\Interfaces\ImageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ImageShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly ImageServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $image = $this->service->getImageById($id);
        $this->authorize('view', $image);
        return new ImageResource($image);
    }
}
