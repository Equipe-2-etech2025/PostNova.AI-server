<?php

namespace App\Services;

use App\Repositories\Interfaces\SocialPostRepositoryInterface;
use App\Services\Interfaces\SocialPostServiceInterface;

class SocialPostService implements SocialPostServiceInterface
{
    protected $repository;

    public function __construct(SocialPostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllSocialPosts(array $filters = [])
    {
        return $this->repository->all();
    }

    public function getSocialPostById(int $id)
    {
        return $this->repository->find($id);
    }

    public function getSocialPostByCriteria(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function createSocialPost(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateSocialPost(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteSocialPost(int $id)
    {
        return $this->repository->delete($id);
    }
}
