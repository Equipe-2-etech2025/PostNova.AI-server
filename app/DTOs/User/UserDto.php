<?php

namespace App\DTOs\User;

class UserDto
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $role,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];
    }
}
