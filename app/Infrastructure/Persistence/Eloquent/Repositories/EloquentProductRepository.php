<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Entities\ProductEntity;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\Product;
use Illuminate\Support\Collection;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::with(['category', 'images'])->get()
            ->map(
                fn($model) =>
                $this->mapToEntity($model)
            );
    }
    public function paginate(int $perPage = 10)
    {
        return Product::with(['category', 'images'])->paginate($perPage);
    }
    public function find(int $id): ?ProductEntity
    {
        $model = Product::find($id);
        $model->load('category');
        $model->load('images');
        return $model ?  $this->mapToEntity($model) : null;
    }
    public function create(ProductEntity $product): ProductEntity
    {
        $data = Product::create($product->toArray());
        $data->load('category');
        $data->load('images');
        return $this->mapToEntity($data);
    }

    public function update(ProductEntity $product): ProductEntity
    {
        $model = Product::findOrFail($product->id);
        $model->update($product->toArray());
        $model->load('category');
        $model->load('images');
        return $this->mapToEntity($model);
    }
    public function delete(int $id): bool
    {
        $product = Product::with('images')->find($id);
        if (!$product) {
            return false;
        }
        return $product->delete();
    }
    private function mapToEntity(Product $model): ProductEntity
    {
        return new ProductEntity(
            id: $model->id,
            name: $model->name,
            description: $model->description,
            short_description: $model->short_description,
            price: $model->price,
            stock: $model->stock,
            discount: $model->discount,
            is_show: $model->is_show,
            category_id: $model->category_id,
            category: $model->category ? $model->category->toArray() : [],
            images: $model->images ? $model->images->toArray() : []
        );
    }
}
