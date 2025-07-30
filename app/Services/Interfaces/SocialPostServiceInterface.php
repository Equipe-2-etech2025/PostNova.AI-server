<?php

namespace App\Services\Interfaces;

interface SocialPostServiceInterface
{
    public function getAllSocialPosts(array $filters = []);
    public function getSocialPostById(int $id);
    public function getSocialPostByCriteria(array $criteria);
    public function createSocialPost(array $data);
    public function updateSocialPost(int $id, array $data);
    public function deleteSocialPost(int $id);
    public function getSocialPostsByUserId(int $userId);
}
