<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Social\SocialDto;
use App\Models\Social;
use App\Models\SocialPost;

interface SocialRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findBy(array $criteria);
    public function create(SocialDto $socialDto) : Social;
    public function update(int $id, SocialDto $socialDto) : Social;
    public function delete(int $id);
}
