<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prompt\CreatePromptRequest;
use App\Http\Requests\Prompt\UpdatePromptRequest;
use App\Http\Resources\Prompt\PromptCollection;
use App\Http\Resources\Prompt\PromptResource;
use App\Models\Campaign;
use App\Models\Prompt;
use App\Services\Interfaces\PromptServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Telescope\AuthorizesRequests;

class PromptController extends Controller
{
    use AuthorizesRequests;

    private PromptServiceInterface $promptService;

    public function __construct(PromptServiceInterface $promptService)
    {
        $this->promptService = $promptService;
    }

    public function index()
    {
        $user = Auth::user();

        $this->authorize('viewAny', Campaign::class);

        if ($user->hasRole('admin')) {
            $prompts = $this->promptService->getAllPrompts();
        } else {
            $prompts = $this->promptService->getPromptByUserId($user->id);
        }

        return new PromptCollection($prompts);
    }

    public function show(int $id)
    {
        $prompt = $this->promptService->getPromptById($id);
        $this->authorize('view', $prompt);
        return new PromptResource($prompt);
    }

    public function store(CreatePromptRequest $request)
    {
        $promptDto = $request->toDto();
        $this->authorize('create', [Prompt::class, $promptDto->campaign_id]);
        $prompt = $this->promptService->createPrompt($promptDto);

        return new PromptResource($prompt);
    }

    public function update(UpdatePromptRequest $request, int $id)
    {
        $prompt = $this->promptService->getPromptById($id);
        $this->authorize('update', $prompt);
        $promptDto = $request->toDto($prompt);
        $updatedPrompt = $this->promptService->updatePrompt($id, $promptDto);

        return new PromptResource($updatedPrompt);
    }


    public function destroy(int $id)
    {
        $prompt = $this->promptService->getPromptById($id);
        $this->authorize('delete', $prompt);
        $this->promptService->deletePrompt($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', Prompt::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->promptService->getPromptByCriteria($criteria);

        return new PromptCollection($results);
    }

}
