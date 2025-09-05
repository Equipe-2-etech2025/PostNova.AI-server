<?php

namespace App\Services\Interfaces;

use App\DTOs\LandingPage\LandingPageDto;

interface LandingPageServiceInterface
{
    public function getAllLandingPages(array $filters = []);

    public function getLandingPageById(int $id);

    public function getLandingPageByCriteria(array $criteria);

    public function createLandingPage(LandingPageDto $landingPageDto);

    public function updateLandingPage(int $id, array $content);

    public function deleteLandingPage(int $id);

    public function getLandingPageByUserId(int $userId);
}
