<?php

namespace App\Application\UseCases\Category;

use App\Domain\Repositories\CategoryRepositoryInterface;

class DeleteCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}
    public function execute(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}
