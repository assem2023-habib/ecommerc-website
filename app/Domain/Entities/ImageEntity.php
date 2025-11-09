<?php

namespace App\Domain\Entities;

class ImageEntity
{
    public function __construct(
        public ?int $id,
        public string $path,
        public ?string $alt_text,
        public bool $is_show,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            path: $data['path'],
            alt_text: $data['alt_text'] ?? null,
            is_show: $data['is_show'] ?? true
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'path' => $this->path,
            'alt_text' => $this->alt_text,
            'is_show' => $this->is_show,
        ];
    }
}
