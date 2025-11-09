<?php

namespace App\Application\UseCases\Category;

use App\Domain\Entities\CategoryEntity;
use App\Domain\Repositories\CategoryRepositoryInterface;

class CreateCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}
    public function execute(CategoryEntity $categoryEntity): CategoryEntity
    {
        return $this->categoryRepository->create($categoryEntity);
    }
}
