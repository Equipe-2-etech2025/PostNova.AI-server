<?php

namespace App\Services\Interfaces;

use App\DTOs\Prompt\PromptDto;

interface PromptServiceInterface
{
    public function getAllPrompts(array $filters = []);
    public function getPromptById(int $id);
    public function getPromptByCriteria(array $criteria);
    public function createPrompt(PromptDto $promptDto);
    public function updatePrompt(int $id, PromptDto $promptDto);
    public function deletePrompt(int $id);
    public function getPromptByUserId(int $userId);
}
