<?php

namespace App\Services;
use App\Repositories\SocialRepository;
use App\Services\Interfaces\SocialServiceInterface;

class SocialService implements SocialServiceInterface
{
    protected $socialRepository;

    public function __construct(SocialRepository $socialRepository)
    {
        $this->socialRepository= $socialRepository;
    }
    public function getallSocial(array $filters = [])
    {
        return $this->socialRepository->all();
    }

    public function getSocialById(int $id)
    {
        return $this->socialRepository->find($id);
    }

    public function updateSocial(int $id, array $data)
    {
        return $this->socialRepository->update($id, $data);
    }

    public function createSocial(array $data)
    {
        return $this->socialRepository->create($data);
    }

    public function deleteSocial(int $id)
    {
        return $this->socialRepository->delete($id);
    }


    public function getSocialByCriteria(array $criteria)
    {
        return $this->socialRepository->findBy($criteria);
    }
}
