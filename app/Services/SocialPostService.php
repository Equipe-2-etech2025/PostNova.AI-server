<?php

namespace App\Services;

use App\DTOs\SocialPost\SocialPostDto;
use App\Models\SocialPost;
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

    public function createSocialPost(SocialPostDto $socialPostDto)
    {
        return $this->repository->create($socialPostDto);
    }

    public function updateSocialPost(int $id, SocialPostDto $socialPostDto)
    {
        return $this->repository->update($id, $socialPostDto);
    }

    public function deleteSocialPost(int $id)
    {
        return $this->repository->delete($id);
    }
    public function getSocialPostsByUserId(int $userId)
    {
        return $this->repository->findByUserId($userId);
    }


}
