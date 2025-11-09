<?php

namespace App\Application\UseCases\Category;

use App\Domain\Entities\CategoryEntity;
use App\Domain\Repositories\CategoryRepositoryInterface;

class UpdateCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}
    public function execute(CategoryEntity $categoryEntity): ?CategoryEntity
    {
        $existing = $this->categoryRepository->find($categoryEntity->id);
        if (!$existing)
            return null;
        return $this->categoryRepository->update($categoryEntity);
    }
}
