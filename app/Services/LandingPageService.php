<?php

namespace App\Services;

use App\Repositories\Interfaces\LandingPageRepositoryInterface;
use App\Services\Interfaces\LandingPageServiceInterface;

class LandingPageService implements LandingPageServiceInterface
{
    protected $repository;

    public function __construct(LandingPageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllLandingPages(array $filters = [])
    {
        return $this->repository->all();
    }

    public function getLandingPageById(int $id)
    {
        return $this->repository->find($id);
    }

    public function getLandingPageByCriteria(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function createLandingPage(array $data)
    {
        if (!isset($data['is_publised'])) {
            $data['status'] = 'false';
        }
        return $this->repository->create($data);
    }

    public function updateLandingPage(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteLandingPage(int $id)
    {
        return $this->repository->delete($id);
    }

    public function getLandingPageByUserId(int $userId)
    {
        return $this->repository->findByUserId($userId);
    }
}

