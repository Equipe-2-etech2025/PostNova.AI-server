<?php

namespace App\Services;

use App\DTOs\Prompt\PromptDto;
use App\Models\Prompt;
use App\Repositories\Interfaces\PromptRepositoryInterface;
use App\Services\Interfaces\PromptServiceInterface;

class PromptService implements PromptServiceInterface
{
    protected $repository;

    public function __construct(PromptRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPrompts(array $filters = [])
    {
        return $this->repository->all();
    }

    public function getPromptById(int $id)
    {
        return $this->repository->find($id);
    }

    public function getPromptByCriteria(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function createPrompt(PromptDto $promptDto)
    {
        return $this->repository->create($promptDto);
    }

    public function updatePrompt(int $id, PromptDto $promptDto)
    {
        return $this->repository->update($id, $promptDto);
    }

    public function deletePrompt(int $id)
    {
        return $this->repository->delete($id);
    }

    public function getPromptByUserId(int $userId)
    {
        return $this->repository->findByUserId($userId);
    }
}
