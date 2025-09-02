<?php

namespace App\Http\Controllers\API\Image;

use App\Http\Controllers\Controller;
use App\Http\Resources\Image\ImageCollection;
use App\Models\Image;
use App\Services\Interfaces\ImageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly ImageServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', Image::class);

        $criteria = $request->query();
        if (! $user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->service->getImageByCriteria($criteria);

        return new ImageCollection($results);
    }
}
