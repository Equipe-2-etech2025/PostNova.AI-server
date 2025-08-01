<?php

namespace App\Repositories;

use App\DTOs\SocialPost\SocialPostDto;
use App\Models\SocialPost;
use App\Repositories\Interfaces\SocialPostRepositoryInterface;

class SocialPostRepository implements SocialPostRepositoryInterface
{
    protected $model;

    public function __construct(SocialPost $model)
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
        $query = SocialPost::query()->with('campaign');

        if (isset($criteria['user_id'])) {
            $query->whereHas('campaign', function ($q) use ($criteria) {
                $q->where('user_id', $criteria['user_id']);
            });
            unset($criteria['user_id']);
        }

        foreach ($criteria as $field => $value) {
            $query->where($field, $value);
        }

        return $query->get();
    }

    public function create(SocialPostDto $socialPostDto) : SocialPost
    {
        return $this->model->create($socialPostDto->toArray());
    }

    public function update(int $id, SocialPostDto $socialPostDto) : SocialPost
    {
        $post = $this->model->findOrFail($id);
        $post->update($socialPostDto->toArray());
        return $post;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findByUserId(int $userId)
    {
        return SocialPost::whereHas('campaign', function ($query) use ($userId)
        {
            $query->where('user_id', $userId);
        })->get();
    }

}
