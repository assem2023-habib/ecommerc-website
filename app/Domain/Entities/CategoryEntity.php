<?php

namespace App\Domain\Entities;

class CategoryEntity
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $description,
        public string $slug,
        public bool $is_show,
        public bool $is_trend,
    ) {}
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            description: $data['description'],
            slug: $data['slug'],
            is_show: $data['is_show'],
            is_trend: $data['is_trend'],
        );
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'is_show' => $this->is_show,
            'is_trend' => $this->is_trend,
        ];
    }
}
