<?php

namespace App\Repositories\Interfaces;

use App\DTOs\SocialPost\SocialPostDto;
use App\Models\SocialPost;

interface SocialPostRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function findBy(array $criteria);

    public function create(SocialPostDto $socialPostDto): SocialPost;

    public function update(int $id, SocialPostDto $socialPostDto): SocialPost;

    public function delete(int $id);

    public function findByUserId(int $userId);
}
