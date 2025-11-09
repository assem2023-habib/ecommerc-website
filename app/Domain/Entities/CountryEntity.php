<?php

namespace App\Domain\Entities;

class CountryEntity
{
    public function __construct(
        public ?int $id,
        public string $country_name,
        public string $country_code,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            country_name: $data['country_name'],
            country_code: $data['country_code'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'country_name' => $this->country_name,
            'country_code' => $this->country_code,
        ];
    }
}
