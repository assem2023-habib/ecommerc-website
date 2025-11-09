<?php

namespace App\Presentation\Http\Controllers\Api\V1;

use App\Application\UseCases\Category\{CreateCategoryUseCase, UpdateCategoryUseCase, GetCategoryUseCase, DeleteCategoryUseCase};
use App\Domain\Entities\CategoryEntity;
use App\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Category\StoreCategoryRequest;
use App\Presentation\Http\Requests\Category\UpdateCategoryRequest;
use App\Presentation\Http\Resources\CategoryResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    public function __construct(
        private readonly GetCategoryUseCase $getCategory,
        private readonly CreateCategoryUseCase $createCategory,
        private readonly UpdateCategoryUseCase $updateCategory,
        private readonly DeleteCategoryUseCase $deleteCategory,
    ) {}
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $categories = $this->getCategory->paginate($perPage);
        return $this->successResponse(
            CategoryResource::collection($categories),
            'Categories fetched successfully',
        );
    }
    public function show(int $id)
    {
        $category = $this->getCategory->find($id);
        if (!$category) {
            return $this->errorResponse('Category not Found', 404);
        }
        return $this->successResponse(
            new CategoryResource($category),
            'Category fetched successfully'
        );
    }
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $entity = new CategoryEntity(
            id: null,
            name: $validated['name'],
            description: $validated['description'] ?? '',
            slug: $validated['slug'],
            is_show: $validated['is_show'] ?? true,
            is_trend: $validated['is_trend'] ?? true,
        );
        $category = $this->createCategory->execute($entity);
        return $this->successResponse(
            new CategoryResource($category),
            'Category created successfully',
            201,
        );
    }
    public function update(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $existing = $this->getCategory->find($id);
        if (!$existing)
            return $this->errorResponse('Category not found', 404);
        $entity = new CategoryEntity(
            id: $id,
            name: $validated['name'],
            description: $validated['description'] ?? $existing->description,
            slug: $validated['slug'] ?? $existing->slug,
            is_show: $validated['is_show'] ?? $existing->is_show,
            is_trend: $validated['is_trend'] ?? $existing->is_trend,
        );
        $updated = $this->updateCategory->execute($entity);
        if (!$updated) {
            return $this->errorResponse('Category not found or update', 404);
        }
        return $this->successResponse(
            new CategoryResource($updated),
            'Category updated successfully',
        );
    }
    public function destroy(int $id): JsonResponse
    {
        $existing = $this->getCategory->find($id);
        if (!$existing) {
            return $this->errorResponse('Category not found', 404);
        }

        $deleted = $this->deleteCategory->execute($id);

        if (!$deleted) {
            return $this->errorResponse('Could not delete category', 500);
        }

        return $this->successResponse(null, 'Category deleted successfully.');
    }
}
