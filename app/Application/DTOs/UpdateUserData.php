<?php

namespace App\Application\DTOs;

class UpdateUserData
{
    public function __construct(
        public int $id,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $user_name = null,
        public ?string $password = null,
        public ?string $phone = null,
        public ?string $birthday = null,
        public ?string $gender = null,
        public ?int $city_id = null,
    ) {}
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'user_name' => $this->user_name,
            'password' => $this->password,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'city_id' => $this->city_id,
        ];
    }
}
