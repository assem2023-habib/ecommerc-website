<?php

namespace App\Presentation\Http\Controllers\Api\V1\Auth;

use App\Application\UseCases\Auth\RegisterUserUseCase;
use App\Application\DTOs\RegisterUserData;
use App\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Auth\RegisterRequest;
use App\Presentation\Http\Resources\UserResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private RegisterUserUseCase $registerUser
    ) {}

    public function register(RegisterRequest $request): JsonResponse
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

        $user = $this->registerUser->execute($data);
        // Create token using the existing User model
        $userModel = \App\Infrastructure\Persistence\Eloquent\Models\User::where('email', $validated['email'])->first();
        $token = $userModel->createToken('auth_token')->plainTextToken;

        return $this->successResponse(
            [
                'user' => new UserResource($user),
                'token' => $token,
            ],
            'User registered successfully',
            201
        );
    }
}
