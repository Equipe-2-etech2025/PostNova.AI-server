<?php

namespace App\Services;

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

    public function createPrompt(array $data)
    {
        return $this->repository->create($data);
    }

    public function updatePrompt(int $id, array $data)
    {
        return $this->repository->update($id, $data);
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
