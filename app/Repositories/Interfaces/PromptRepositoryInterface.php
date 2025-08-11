<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Prompt\PromptDto;
use App\Models\Prompt;

interface PromptRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function findBy(array $criteria);

    public function create(PromptDto $promptDto): Prompt;

    public function update(int $id, PromptDto $promptDto): Prompt;

    public function delete(int $id);

    public function findByUserId(int $userId);

    public function countTodayPromptsByUser(int $userId);
}
