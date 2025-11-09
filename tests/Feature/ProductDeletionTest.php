<?php

use App\Infrastructure\Persistence\Eloquent\Models\Product;
use App\Infrastructure\Persistence\Eloquent\Models\Image;
use App\Infrastructure\Services\FileStorageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_deletion_deletes_associated_images()
    {
        // Arrange
        Storage::fake('public');

        // Create a product with images
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'short_description' => 'Short Description',
            'price' => 100.00,
            'stock' => 10,
            'discount' => 0,
            'is_show' => true,
            'category_id' => 1,
        ]);

        // Create fake uploaded files and store them
        $file1 = \Illuminate\Http\UploadedFile::fake()->image('product1.jpg');
        $file2 = \Illuminate\Http\UploadedFile::fake()->image('product2.jpg');

        $fileStorageService = app(FileStorageService::class);
        $url1 = $fileStorageService->upload($file1, 'products');
        $url2 = $fileStorageService->upload($file2, 'products');

        // Create image records
        $product->images()->create(['path' => $url1, 'is_show' => true]);
        $product->images()->create(['path' => $url2, 'is_show' => true]);

        // Verify images exist in storage
        Storage::disk('public')->assertExists('uploads/products/' . $file1->hashName());
        Storage::disk('public')->assertExists('uploads/products/' . $file2->hashName());

        // Verify images exist in database
        $this->assertEquals(2, $product->images()->count());

        // Act
        $product->delete();

        // Assert
        // Product should be deleted (soft delete if applicable, or completely removed)
        $this->assertModelMissing($product);

        // Images should be deleted from database
        $this->assertEquals(0, Image::where('imageable_type', Product::class)->count());

        // Files should be deleted from storage
        Storage::disk('public')->assertMissing('uploads/products/' . $file1->hashName());
        Storage::disk('public')->assertMissing('uploads/products/' . $file2->hashName());
    }
}
