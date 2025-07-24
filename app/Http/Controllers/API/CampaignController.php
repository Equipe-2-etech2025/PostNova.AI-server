<?php
namespace App\Http\Controllers\API;

use App\Http\Requests\Campaign\CreateCampaignRequest;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Http\Resources\Campaign\CampaignResource;
use App\Http\Resources\Campaign\CampaignCollection;
use App\Models\Campaign;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class CampaignController extends Controller
{
    use AuthorizesRequests;
    private CampaignServiceInterface $service;

    public function __construct(CampaignServiceInterface $service)
    {
        $this->service = $service;
        $this->middleware('auth:sanctum');
    }
    public function index(): JsonResponse
    {
        try {
            $campaigns = $this->service->getAllCampaigns();
            return response()->json(new CampaignCollection($campaigns));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération des campagnes', $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $campaign = $this->service->getCampaignById($id);
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return response()->json(new CampaignResource($campaign));
    }

    public function store(CreateCampaignRequest $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $campaign = Campaign::create([
            'name' => $request->name,
            'description' => $request->description,
            'status'=> $request->status,
                'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Campagne créée avec succès.',
            'campaign' => $campaign,
            'user' => $user,
        ]);
    }

    public function update(UpdateCampaignRequest $request, int $id): JsonResponse
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        try {
            $campaign = Campaign::findOrFail($id);

            // Vérifier si l'utilisateur est propriétaire de la campagne
            if ($campaign->user_id !== $user->id) {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }

            $campaign->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return response()->json([
                'message' => 'Campagne mise à jour avec succès.',
                'campaign' => $campaign,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour de la campagne', 'error' => $e->getMessage()], 500);
        }

    }


    public function destroy(int $id): JsonResponse
    {
        return $this->service->deleteCampaign($id);
    }


}
