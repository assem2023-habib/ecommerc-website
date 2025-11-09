<?php

namespace App\Application\DTOs;

class RegisterUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $user_name,
        public string $password,
        public ?string $phone,
        public ?string $birthday,
        public ?string $gender,
        public int $city_id,
    ) {}
}
