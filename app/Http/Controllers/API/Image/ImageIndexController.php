<?php

namespace App\Http\Controllers\API\Image;

use App\Http\Controllers\Controller;
use App\Http\Resources\Image\ImageCollection;
use App\Models\Campaign;
use App\Services\Interfaces\ImageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ImageIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly ImageServiceInterface $service
    ) {}

    public function __invoke()
    {
        $user = Auth::user();
        $this->authorize('viewAny', Campaign::class);

        $images = $user->hasRole('admin')
            ? $this->service->getAllImages()
            : $this->service->getImageByUserId($user->id);

        return new ImageCollection($images);
    }
}
