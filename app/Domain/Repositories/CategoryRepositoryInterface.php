<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\CategoryEntity;

interface CategoryRepositoryInterface
{
    public function all(): array;
    public function paginate(int $perpage = 10);
    public function find(int $id): ?CategoryEntity;
    public function create(CategoryEntity $category): CategoryEntity;
    public function update(CategoryEntity $category): CategoryEntity;
    public function delete(int $id): bool;
}
