<?php

namespace App\Repositories\Interfaces;

use App\DTOs\LandingPage\LandingPageDto;
use App\Models\LandingPage;

interface LandingPageRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function findBy(array $criteria);

    public function create(LandingPageDto $landingPageDto): LandingPage;

    public function update(int $id, LandingPageDto $landingPageDto): LandingPage;

    public function delete(int $id);

    public function findByUserId(int $id);
}
