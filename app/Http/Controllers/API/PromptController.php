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
        $data = $request->validated();
        $this->authorize('create', [Prompt::class, $data['campaign_id']]);
        $prompt = $this->promptService->createPrompt($data);

        return new  PromptResource($prompt);
    }

    public function update(UpdatePromptRequest $request, int $id)
    {
        $prompt = $this->promptService->getPromptById($id);
        $this->authorize('update', $prompt);

        $prompt = $this->promptService->updatePrompt($id, $request->validated());

        return new PromptResource($prompt);
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
        $prompts = $this->promptService->getPromptByCriteria($request->query());

        return new PromptCollection($prompts);
    }

    public function getQuotaByUserId(int $userId)
    {
        return $this->promptService->countTodayPromptsByUser($userId);
    }
}
