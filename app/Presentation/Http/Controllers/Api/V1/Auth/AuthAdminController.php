<?php

namespace App\Presentation\Http\Controllers\Api\V1\Auth;

use App\Application\DTOs\LoginUserData;
use App\Application\DTOs\RegisterUserData;
use App\Application\DTOs\UpdateUserData;
use App\Application\UseCases\Auth\DeleteAdminUseCase;
use App\Application\UseCases\Auth\LoginAdminUseCase;
use App\Application\UseCases\Auth\PromoteToAdminUseCase;
use App\Application\UseCases\Auth\RegisterAdminUseCase;
use App\Application\UseCases\Auth\UpdateAdminUseCase;
use App\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Auth\LoginRequest;
use App\Presentation\Http\Requests\Auth\RegisterRequest;
use App\Presentation\Http\Requests\User\UpdateUserRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AuthAdminController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private RegisterAdminUseCase $registerAdmin,
        private UpdateAdminUseCase $updateAdmin,
        private DeleteAdminUseCase $deleteAdmin,
        private PromoteToAdminUseCase $promoteToAdmin,
        private LoginAdminUseCase $loginAdmin,
    ) {}

    public function loginAdmin(LoginRequest $request)
    {
        $validated = $request->validated();
        $data = new LoginUserData(
            email: $validated['email'],
            password: $validated['password'],
        );

        $user = $this->loginAdmin->execute($data);

        if (!$user) {
            return $this->errorResponse('Invalid credentials', 401);
        }
        $userModel = \App\Infrastructure\Persistence\Eloquent\Models\User::where('email', $validated['email'])->first();
        $token = $userModel->createToken('auth_token')->plainTextToken;
        return $this->successResponse(
            [
                'user' => $user,
                'token' => $token,
            ],
            'Login successful',
            200
        );
    }
    public function registerAdmin(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = new RegisterUserData(
            name: $validated['name'],
            email: $validated['email'],
            user_name: $validated['user_name'],
            password: $validated['password'],
            phone: $validated['phone'] ?? null,
            birthday: $validated['birthday'] ?? null,
            gender: $validated['gender'] ?? null,
            city_id: $validated['city_id'],
        );

        $user = $this->registerAdmin->execute($data);
        $userModel = \App\Infrastructure\Persistence\Eloquent\Models\User::where('email', $validated['email'])->first();
        $token = $userModel->createToken('auth_token')->plainTextToken;
        return $this->successResponse(
            [
                'user' => $user,
                'token' => $token,
            ],
            'Admin user created successfully',
            201
        );
    }

    public function updateAdmin(int $id, UpdateUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = new UpdateUserData(
            id: $id,
            name: $validated['name'] ?? null,
            email: $validated['email'] ?? null,
            user_name: $validated['user_name'] ?? null,
            password: $validated['password'] ?? null,
            phone: $validated['phone'] ?? null,
            birthday: $validated['birthday'] ?? null,
            gender: $validated['gender'] ?? null,
            city_id: $validated['city_id'] ?? null,
        );

        try {
            $user = $this->updateAdmin->execute($data, $id);
            return $this->successResponse(
                $user,
                'Admin user updated successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('User not found or update failed', 404);
        }
    }

    public function deleteAdmin(int $id): JsonResponse
    {
        $deleted = $this->deleteAdmin->execute($id);
        if (!$deleted) {
            return $this->errorResponse('User not found or deletion failed', 404);
        }
        return $this->successResponse(
            null,
            'Admin user deleted successfully'
        );
    }

    public function promoteToAdmin(int $id): JsonResponse
    {
        $promoted = $this->promoteToAdmin->execute($id);
        if (!$promoted) {
            return $this->errorResponse('User not found or promotion failed', 404);
        }
        return $this->successResponse(
            null,
            'User promoted to admin successfully'
        );
    }
}
