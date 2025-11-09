<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * إرجاع استجابة موحدة لنجاح العملية
     */
    protected function successResponse(mixed $data = [], string $message, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }

    /**
     * إرجاع استجابة موحدة عند حدوث خطأ
     */
    protected function errorResponse(string $message, mixed $errors = [], int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => $message,
                'errors' => $errors,
            ],
        ], $statusCode);
    }
}
