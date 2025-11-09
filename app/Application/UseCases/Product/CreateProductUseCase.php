<?php

namespace App\Application\UseCases\Product;

use App\Domain\Entities\ProductEntity;
use App\Domain\Repositories\ProductRepositoryInterface;

class CreateProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}
    public function execute(ProductEntity $productEntity): ProductEntity
    {
        return $this->productRepository->create($productEntity);
    }
}
