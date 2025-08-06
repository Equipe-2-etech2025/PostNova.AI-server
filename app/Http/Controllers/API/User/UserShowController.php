<?php
namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserShowController extends Controller
{
    public function __invoke(User $user): JsonResponse
    {
        $this->authorize('viewAny', $user);
        return response()->json([
            'success' => true,
            'data' => new UserResource($user),
        ]);
    }
}
