<?php

namespace App\Services\Interfaces;

use App\DTOs\Social\SocialDto;

interface SocialServiceInterface
{
    public function getAllSocial(array $filters = []);
    public function getSocialById(int $id);
    public function getSocialByCriteria(array $criteria);
    public function updateSocial(int $id, SocialDto $socialDto);
    public function createSocial(SocialDto $socialDto);
    public function deleteSocial(int $id);
}
