<?php

namespace App\Observers;

use App\Infrastructure\Persistence\Eloquent\Models\Product;
use App\Infrastructure\Services\FileStorageService;

class ProductObserver
{
    public function created(Product $product) {}

    public function deleting(Product $product)
    {
        foreach ($product->images as $image) {
            app(FileStorageService::class)->delete($image->path);
            $image->delete();
        }
    }
    /**
     * Handle the App\Infrastructure\Persistence\Eloquent\Models\Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        foreach ($product->images as $image) {
            app(FileStorageService::class)->delete($image->path);
            $image->delete();
        }
    }
}
