<?php

namespace App\Repositories;

use App\DTOs\Prompt\PromptDto;
use App\Models\Prompt;
use App\Repositories\Interfaces\PromptRepositoryInterface;
use Illuminate\Support\Carbon;

class PromptRepository implements PromptRepositoryInterface
{
    protected $model;

    public function __construct(Prompt $model)
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

    public function create(PromptDto $promptDto) :  Prompt
    {
        return $this->model->create($promptDto->toArray());
    }

    public function update(int $id, PromptDto $promptDto) : Prompt
    {
        $prompt = $this->model->findOrFail($id);
        $prompt->update($promptDto->toArray());
        return $prompt;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findByUserId(int $userId)
    {
        return Prompt::whereHas('campaign', function ($query) use ($userId)
        {
            $query->where('user_id', $userId);
        })->get();
    }

    public function countTodayPromptsByUser(int $userId): int
    {
        return $this->model
            ->whereHas('campaign', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->whereDate('created_at', Carbon::today())
            ->count();
    }
}
