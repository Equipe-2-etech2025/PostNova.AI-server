<?php

namespace App\Services\Interfaces;

use App\DTOs\SocialPost\SocialPostDto;

interface SocialPostServiceInterface
{
    public function getAllSocialPosts(array $filters = []);
    public function getSocialPostById(int $id);
    public function getSocialPostByCriteria(array $criteria);
    public function createSocialPost(SocialPostDto $socialPostDto);
    public function updateSocialPost(int $id, SocialPostDto $socialPostDto);
    public function deleteSocialPost(int $id);
    public function getSocialPostsByUserId(int $userId);
}
