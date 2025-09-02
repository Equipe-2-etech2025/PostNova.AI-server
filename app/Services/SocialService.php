<?php

namespace App\Services;

use App\DTOs\Social\SocialDto;
use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Services\Interfaces\SocialServiceInterface;

class SocialService implements SocialServiceInterface
{
    protected $socialRepository;

    public function __construct(SocialRepositoryInterface $socialRepository)
    {
        $this->socialRepository = $socialRepository;
    }

    public function getAllSocial(array $filters = [])
    {
        return $this->socialRepository->all();
    }

    public function getSocialById(int $id)
    {
        return $this->socialRepository->find($id);
    }

    public function getSocialByCriteria(array $criteria)
    {
        return $this->socialRepository->findBy($criteria);
    }

    public function updateSocial(int $id, SocialDto $socialDto)
    {
        return $this->socialRepository->update($id, $socialDto);
    }

    public function createSocial(SocialDto $socialDto)
    {
        return $this->socialRepository->create($socialDto);
    }

    public function deleteSocial(int $id)
    {
        return $this->socialRepository->delete($id);
    }
}
