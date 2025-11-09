<?php

namespace App\Domain\Entities;

class ProductEntity
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
        public ?string $short_description,
        public float $price,
        public int $stock,
        public float $discount,
        public bool $is_show,
        public int $category_id,
        public array $category = [],
        public array $images = []
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            description: $data['description'] ?? null,
            short_description: $data['short_description'] ?? null,
            price: $data['price'],
            stock: $data['stock'],
            discount: $data['discount'],
            is_show: $data['is_show'],
            category_id: $data['category_id'],
            category: $data['category'] ?? [],
            images: $data['images'] ?? []
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'price' => $this->price,
            'stock' => $this->stock,
            'discount' => $this->discount,
            'is_show' => $this->is_show,
            'category_id' => $this->category_id,
            'category' => $this->category,
            'images' => $this->images,
        ];
    }
}
