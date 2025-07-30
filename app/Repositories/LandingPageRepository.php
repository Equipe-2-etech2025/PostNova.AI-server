<?php

namespace App\Repositories;

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
            if ($field === 'is_published') {
                $query->where('is_published', filter_var($value, FILTER_VALIDATE_BOOLEAN));
            } elseif (is_numeric($value)) {
                $query->where($field, $value);
            } else {
                $query->whereRaw('LOWER(' . $field . ') = ?', [strtolower($value)]);
            }
        }

        return $query->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $landingPage = $this->model->findOrFail($id);
        $landingPage->update($data);
        return $landingPage;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findByUserId(int $userId)
    {
        return LandingPage::whereHas('campaign', function ($query) use ($userId)
        {
            $query->where('user_id', $userId);
        })->get();
    }
}
