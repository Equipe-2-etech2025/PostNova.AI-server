<?php

namespace App\Http\Controllers\API\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\UpdateImageRequest;
use App\Http\Resources\Image\ImageResource;
use App\Models\Campaign;
use App\Models\Image;
use App\Services\Interfaces\ImageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ImageUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly ImageServiceInterface $service
    ) {}

    public function __invoke(UpdateImageRequest $request, int $id)
    {
        $image = $this->service->getImageById($id);
        $updatedImage = $this->service->updateImage($id, $request->toDto($image));
        $this->authorize('update', $updatedImage);

        return new ImageResource($updatedImage);
    }
}
