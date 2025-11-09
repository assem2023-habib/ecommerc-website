<?php

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function __construct($resource)
    {
        // If resource is an array, convert it to ProductEntity
        if (is_array($resource)) {
            $resource = \App\Domain\Entities\ProductEntity::fromArray($resource);
        }
        // If resource is an Eloquent model, use it directly
        elseif (is_object($resource) && method_exists($resource, 'toArray')) {
            // Keep as Eloquent model for snake_case properties
        }

        parent::__construct($resource);
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? $this->resource['id'] ?? null,
            'name' => $this->name ?? $this->resource['name'] ?? null,
            'description' => $this->description ?? $this->resource['description'] ?? null,
            'short_description' => $this->short_description ?? $this->resource['short_description'] ?? null,
            'price' => $this->price ?? $this->resource['price'] ?? null,
            'stock' => $this->stock ?? $this->resource['stock'] ?? null,
            'is_show' => $this->is_show ?? $this->resource['is_show'] ?? null,
            'discount' => $this->discount ?? $this->resource['discount'] ?? null,
            'category_id' => $this->category_id ?? $this->resource['category_id'] ?? null,
            'category' => $this->category ?? $this->resource['category'] ?? [],
            'images' => $this->images ?? $this->resource['images'] ?? [],
        ];
    }
}
