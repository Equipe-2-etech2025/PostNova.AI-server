<?php

namespace App\Services\Interfaces;

interface SocialServiceInterface
{
    public function getAllSocial(array $filters = []);
    public function getSocialById(int $id);
    public function getSocialByCriteria(array $criteria);
    public function updateSocial(int $id, array $data);
    public function createSocial(array $data);
    public function deleteSocial(int $id);
}
