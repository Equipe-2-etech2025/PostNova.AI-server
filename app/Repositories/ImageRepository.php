<?php

namespace App\Repositories;

use App\DTOs\Image\ImageDto;
use App\Models\Image;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    protected $model;

    public function __construct(Image $model)
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

    public function create(ImageDto $imageDto) : Image
    {
        return $this->model->create($imageDto->toArray());
    }

    public function update(int $id, ImageDto $imageDto) : Image
    {
        $image = $this->model->findOrFail($id);
        $image->update($imageDto->toArray());
        return $image;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findByUserId(int $userId)
    {
        return Image::whereHas('campaign', function ($query) use ($userId)
        {
            $query->where('user_id', $userId);
        })->get();
    }
}
