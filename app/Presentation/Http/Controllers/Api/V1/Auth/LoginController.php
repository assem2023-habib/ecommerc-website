<?php

namespace App\Presentation\Http\Controllers\Api\V1\Auth;

use App\Application\UseCases\Auth\LoginUserUseCase;
use App\Application\DTOs\LoginUserData;
use App\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Auth\LoginRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private LoginUserUseCase $loginUser
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = new LoginUserData(
            email: $validated['email'],
            password: $validated['password'],
        );

        $user = $this->loginUser->execute($data);

        if (!$user) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        // Create token using the existing User model
        $userModel = \App\Infrastructure\Persistence\Eloquent\Models\User::where('email', $validated['email'])->first();
        $token = $userModel->createToken('auth_token')->plainTextToken;

        return $this->successResponse(
            [
                'user' => $user,
                'token' => $token,
            ],
            'Login successful'
        );
    }
}
