<?php

namespace App\Repositories;

use App\DTOs\LandingPage\LandingPageDto;
use App\Models\LandingPage;
use App\Repositories\Interfaces\LandingPageRepositoryInterface;

class LandingPageRepository implements LandingPageRepositoryInterface
{
    protected $model;

    public function __construct(LandingPage $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findBy(array $criteria)
    {
        $query = $this->model->query();

        foreach ($criteria as $field => $value) {
            if ($field === 'user_id') {
                $query->whereHas('campaign', function ($q) use ($value) {
                    $q->where('user_id', $value);
                });

                continue;
            }

            if ($field === 'is_published') {
                $boolValue = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                $query->where('is_published', $boolValue);

                continue;
            }

            if (is_numeric($value)) {
                $query->where($field, $value);
            } else {
                $query->where($field, 'ilike', '%'.$value.'%');
            }
        }

        return $query->get();
    }

    public function create(LandingPageDto $landingPageDto): LandingPage
    {
        return $this->model->create($landingPageDto->toArray());
    }

    public function update(int $id, LandingPageDto $landingPageDto): LandingPage
    {
        $landingPage = $this->model->findOrFail($id);
        $landingPage->update($landingPageDto->toArray());

        return $landingPage;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findByUserId(int $userId)
    {
        return LandingPage::whereHas('campaign', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    }
}
