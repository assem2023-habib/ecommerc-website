<?php

namespace App\Domain\Entities;

class CityEntity
{
    public function __construct(
        public ?int $id,
        public string $city_name,
        public int $country_id,
        public array $country = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            city_name: $data['city_name'],
            country_id: $data['country_id'],
            country: $data['country'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'city_name' => $this->city_name,
            'country_id' => $this->country_id,
            'country' => $this->country,
        ];
    }
}
