<?php

namespace App\Application\UseCases\Product;

use App\Domain\Entities\ProductEntity;
use App\Domain\Repositories\ProductRepositoryInterface;

class UpdateProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}
    public function execute(int $id,  array $data): ?ProductEntity
    {
        $existing = $this->productRepository->find($id);
        if (!$existing)
            return null;

        // الحفاظ على الصور الموجودة إلا إذا تم تحديثها
        $images = $data['images'] ?? $existing->images;

        $product = new ProductEntity(
            id: $id,
            name: $data['name'] ?? $existing->name,
            description: $data['description'] ?? $existing->description,
            short_description: $data['short_description'] ?? $existing->short_description,
            price: $data['price'] ?? $existing->price,
            stock: $data['stock'] ?? $existing->stock,
            is_show: $data['is_show'] ?? $existing->is_show,
            category_id: $data['category_id'] ?? $existing->category_id,
            category: $existing->category,
            images: $images,
            discount: $data['discount'] ?? $existing->discount,
        );
        return $this->productRepository->update($product);
    }
}
