<?php

namespace App\Services\Interfaces;

interface PromptServiceInterface
{
    public function getAllPrompts(array $filters = []);
    public function getPromptById(int $id);
    public function getPromptByCriteria(array $criteria);
    public function createPrompt(array $data);
    public function updatePrompt(int $id, array $data);
    public function deletePrompt(int $id);
    public function getPromptByUserId(int $userId);
    public function countTodayPromptsByUser(int $userId);
}
