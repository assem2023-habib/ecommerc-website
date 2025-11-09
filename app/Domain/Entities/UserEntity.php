<?php

namespace App\Domain\Entities;

class UserEntity
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $email,
        public string $user_name,
        public ?string $phone,
        public ?string $birthday,
        public ?string $gender,
        public ?int $city_id,
        public array $city = [],
    ) {}
    public static function fromArray(array $data)
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            email: $data['email'],
            user_name: $data['user_name'],
            phone: $data['phone'] ?? null,
            gender: $data['gender'] ?? null,
            birthday: $data['birthday'] ?? null,
            city_id: $data['city_id'],
            city: $data['city'] ?? [],
        );
    }
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'user_name' => $this->user_name,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'city_id' => $this->city_id,
            'city' => $this->city
        ];
    }
}
