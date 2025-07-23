<?php

namespace App\Services\Interfaces;

interface SocialServiceInterface
{
    public function getallSocial(array $filters = []);
    public function getById(int $id);
    public function updateSocial(int $id, array $data);
    public function createSocial(array $data);
    public function deleteSocial(int $id);
}
