<?php

namespace App\Application\UseCases\Product;

use App\Domain\Entities\ProductEntity;
use App\Domain\Repositories\ProductRepositoryInterface;

class GetProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function all()
    {
        return $this->productRepository->all();
    }
    public function paginate(int $perPage = 10){
        return $this->productRepository->paginate($perPage);
    }
    public function find(int $id)
    {
        return $this->productRepository->find($id);
    }
}
