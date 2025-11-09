<?php

namespace App\Application\UseCases\Product;

use App\Domain\Repositories\ProductRepositoryInterface;

class DeleteProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}
    public function execute(int $id)
    {
        return $this->productRepository->delete($id);
    }
}
