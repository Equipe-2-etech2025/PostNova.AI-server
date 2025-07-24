<?php

namespace App\Services\Interfaces;

interface LandingPageServiceInterface
{
    public function getAllLandingPages(array $filters = []);
    public function getLandingPageById(int $id);
    public function getLandingPageByCriteria(array $criteria);
    public function createLandingPage(array $data);
    public function updateLandingPage(int $id, array $data);
    public function deleteLandingPage(int $id);
}
