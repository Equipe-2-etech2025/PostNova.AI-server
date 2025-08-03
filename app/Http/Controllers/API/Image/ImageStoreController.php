<?php

namespace App\Http\Controllers\API\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\CreateImageRequest;
use App\Http\Resources\Image\ImageResource;
use App\Models\Image;
use App\Services\Interfaces\ImageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ImageStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly ImageServiceInterface $service
    ) {}

    public function __invoke(CreateImageRequest $request)
    {
        $imageDto = $request->toDto();
        $this->authorize('create', [Image::class, $imageDto->campaign_id]);
        $image = $this->service->createImage($imageDto);
        return new ImageResource($image);
    }
}
