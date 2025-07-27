<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\PromptServiceInterface;
use Illuminate\Http\Request;
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
        return $this->promptService->getAllPrompts();
    }

    public function show(int $id)
    {
        return $this->promptService->getPromptById($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->promptService->createPrompt($data);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        return $this->promptService->updatePrompt($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->promptService->deletePrompt($id);
    }

    public function showByCriteria(Request $request)
    {
        return $this->promptService->getPromptByCriteria($request->query());
    }
}
