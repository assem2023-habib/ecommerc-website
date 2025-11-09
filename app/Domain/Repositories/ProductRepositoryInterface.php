<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\ProductEntity;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;
    public function paginate(int $perPage = 10);
    public function find(int $id): ?ProductEntity;
    public function create(ProductEntity $product): ProductEntity;
    public function update(ProductEntity $product): ProductEntity;
    public function delete(int $id): bool;
}
