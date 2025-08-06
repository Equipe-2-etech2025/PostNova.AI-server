<?php
namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserIndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->authorize('viewAny', User::class);
        } catch (AuthorizationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Accès non autorisé.',
            ], 403);
        }

        $query = User::query();

        if ($request->has('role')) {
            $query->withRole($request->role);
        }

        if ($request->has('verified')) {
            $request->boolean('verified')
                ? $query->verified()
                : $query->whereNull('email_verified_at');
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $perPage = $request->get('per_page', 15);

        $users = $query->orderBy($sortBy, $sortOrder)
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => UserResource::collection($users)->response()->getData(),
        ]);
    }
}
