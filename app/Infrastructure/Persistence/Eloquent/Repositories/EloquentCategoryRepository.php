<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Entities\CategoryEntity;
use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\Category;
use Illuminate\Support\Collection;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function all(): array
    {
        return Category::all()
            ->map(fn($model) => $this->toEntity($model))
            ->toArray();
    }
    public function paginate(int $perpage = 10)
    {
        return Category::paginate($perpage);
    }
    public function find(int $id): ?CategoryEntity
    {
        $category = Category::find($id);
        return $category ? $this->toEntity($category) : null;
    }
    public function create(CategoryEntity $category): CategoryEntity
    {
        $model = Category::create($category->toArray());
        return $this->toEntity($model);
    }
    public function update(CategoryEntity $category): CategoryEntity
    {
        $model = Category::findOrFail($category->id);
        $model->update($category->toArray());
        return $this->toEntity($model);
    }
    public function delete(int $id): bool
    {
        $model = Category::find($id);
        return $model ? $model->delete() : false;
    }
    private function toEntity(Category $model): CategoryEntity
    {
        return CategoryEntity::fromArray($model->toArray());
    }
}
