<?php

namespace App\Presentation\Http\Controllers\Api\V1;

use App\Application\UseCases\Product\{CreateProductUseCase, UpdateProductUseCase, GetProductUseCase, DeleteProductUseCase};
use App\Domain\Entities\ProductEntity;
use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\Models\Product;
use App\Infrastructure\Services\FileStorageService;
use App\Presentation\Http\Requests\Products\{StoreProductRequestRequest, UpdateProductRequestRequest};
use App\Presentation\Http\Resources\ProductResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\{JsonResponse, Request};

class ProductController extends Controller
{
    use ApiResponseTrait;
    public function __construct(
        private GetProductUseCase $getProduct,
        private CreateProductUseCase $createProduct,
        private UpdateProductUseCase $updateProduct,
        private DeleteProductUseCase $deleteProduct,
        private FileStorageService $fileStorageService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 10);
        $products = $this->getProduct->paginate($perPage);
        return $this->successResponse(
            ProductResource::collection($products),
            'Products retrieved successfully',
            statusCode: 200,
        );
    }
    public function show($id): JsonResponse
    {
        $product = $this->getProduct->find($id);
        return $product ? $this->successResponse(
            new ProductResource($product),
            'Product retrieved successfully',
            statusCode: 200,
        ) :
            $this->errorResponse(message: 'Product not found', errors: [], statusCode: 404);
    }

    public function store(StoreProductRequestRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $entity = new ProductEntity(
            id: null,
            name: $validated['name'],
            description: $validated['description'] ?? null,
            short_description: $validated['short_description'] ?? null,
            price: $validated['price'],
            stock: $validated['stock'] ?? 0,
            is_show: $validated['is_show'] ?? true,
            category_id: $validated['category_id'] ?? 0,
            discount: $validated['discount'] ?? 0,
        );
        $product = $this->createProduct->execute($entity);
        if ($request->hasFile('images')) {
            $productModel = Product::find($product->id);
            foreach ($request->file('images') as $file) {
                $url = $this->fileStorageService->upload($file, 'products');
                if ($productModel) {
                    $productModel->images()->create(['path' => $url, 'is_show' => true]);
                }
            }
            // Reload product with images
            $product = $this->getProduct->find($product->id);
        }
        return $this->successResponse(
            new ProductResource($product),
            'Product created successfully',
            statusCode: 201,
        );
    }
    public function update(UpdateProductRequestRequest $request, int $id)
    {
        $data = $request->validated();
        $existing = $this->getProduct->find($id);
        if (!$existing)
            return $this->errorResponse('Product not found', 404);

        $product = $this->updateProduct->execute($id, $data);
        if ($request->hasFile('images')) {
            $productModel = \App\Infrastructure\Persistence\Eloquent\Models\Product::find($id);
            foreach ($request->file('images') as $file) {
                $url = $this->fileStorageService->upload($file, 'products');
                $productModel->images()->create([
                    'path' => $url,
                    'is_show' => true,
                ]);
            }
            // Reload product with images
            $product = $this->getProduct->find($id);
        }
        return $product ?
            $this->successResponse(
                new ProductResource($product),
                'Product updated successfully',
                statusCode: 200,
            ) :
            $this->errorResponse(message: 'Product not found', errors: [], statusCode: 404);
    }
    public function destroy(int $id): JsonResponse
    {
        $existing = $this->getProduct->find($id);
        if (!$existing) {
            return $this->errorResponse('Product not found', 404);
        }

        $deleted = $this->deleteProduct->execute($id);

        if (!$deleted) {
            return $this->errorResponse('Could not delete Product', 500);
        }

        return $this->successResponse(null, 'Product deleted successfully.');
    }
}
