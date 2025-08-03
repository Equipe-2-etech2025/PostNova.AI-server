<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\CreateImageRequest;
use App\Http\Requests\Image\UpdateImageRequest;
use App\Http\Resources\Image\ImageCollection;
use App\Http\Resources\Image\ImageResource;
use App\Models\Campaign;
use App\Services\Interfaces\ImageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Telescope\AuthorizesRequests;

class ImageController extends Controller
{
    use AuthorizesRequests;

    private ImageServiceInterface $imageService;

    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $user = Auth::user();

        $this->authorize('viewAny', Campaign::class);

        if ($user->hasRole('admin')) {
            $images = $this->imageService->getAllImages();
        } else {
            $images = $this->imageService->getImageByUserId($user->id);
        }

        return new ImageCollection($images);
    }

    public function show(int $id)
    {
        $image = $this->imageService->getImageById($id);
        $this->authorize('view', $image);
        return new ImageResource($image);
    }

    public function store(CreateImageRequest $request)
    {
        $imageDto = $request->toDto();
        $this->authorize('create', [Image::class, $imageDto->campaign_id]);
        $image = $this->imageService->createImage($imageDto);

        return new ImageResource($image);
    }

    public function update(UpdateImageRequest $request, int $id)
    {
        $image = $this->imageService->getImageById($id);
        $this->authorize('update', $image);
        $imageDto = $request->toDto($image);
        $updatedImage = $this->imageService->updateImage($id, $imageDto);

        return new ImageResource($updatedImage);
    }


    public function destroy(int $id)
    {
        $image = $this->imageService->getImageById($id);
        $this->authorize('delete', $image);
        $this->imageService->deleteImage($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', Image::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->imageService->getImageByCriteria($criteria);

        return new ImageCollection($results);
    }

}
