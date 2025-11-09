<?php

namespace App\Application\DTOs;

class LoginUserData
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
