<?php

namespace App\Services\Interfaces;

interface SuggestionServiceInterface
{
    public function getSuggestions(int $userId): array;
}
