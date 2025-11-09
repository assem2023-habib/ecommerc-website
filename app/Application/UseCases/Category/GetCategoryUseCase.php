<?php

namespace App\Application\UseCases\Category;

use App\Domain\Repositories\CategoryRepositoryInterface;

class GetCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}

    public function all()
    {
        return $this->categoryRepository->all();
    }
    public function paginate(int $perpage = 10)
    {
        return $this->categoryRepository->paginate($perpage);
    }
    public function find(int $id)
    {
        return $this->categoryRepository->find($id);
    }
}
