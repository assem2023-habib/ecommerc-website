<?php

namespace App\Presentation\Http\Controllers\Api\V1\Auth;

use App\Application\DTOs\UpdateUserData;
use App\Application\UseCases\User\DeleteUserUseCase;
use App\Application\UseCases\User\GetUserUseCase;
use App\Application\UseCases\User\UpdateUserUseCase;
use App\Http\Controllers\Controller;
use App\Presentation\Http\Requests\User\UpdateUserRequest;
use App\Presentation\Http\Resources\UserResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiResponseTrait;
    public function __construct(
        private GetUserUseCase $getUser,
        private UpdateUserUseCase $updateUser,
        private DeleteUserUseCase $deleteUser,
    ) {}

    public function profile()
    {
        $user =  Auth::user();

        if (!$user) {
            return $this->errorResponse('Unauthorized', [], 401);
        }

        $user->load('city');

        return $this->successResponse(
            [
                'user' => new UserResource($user)
            ],
            'Profile retrieved successfully',
            200
        );
    }
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $users = $this->getUser->paginate($perPage);
        return $this->successResponse(
            UserResource::collection($users),
            'Users retrieved successfully'
        );
    }
    public function show(int $id)
    {
        $user = $this->getUser->find($id);
        return $user ?
            $this->successResponse(
                new UserResource($user),
                'User retrieved successfully'
            ) :
            $this->errorResponse('User not found', [], 404);
    }
    public function update(UpdateUserRequest $request, int $id)
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

        $user = $this->updateUser->execute($data);
        if (!$user) {
            return $this->errorResponse('User not found or update failed', 404);
        }
        return $this->successResponse(
            new UserResource($user),
            'User updated successfully'
        );
    }
    public function logout(Request $request)
    {
        try {

            $user = Auth::user();;
            if ($user->tokens()->delete()) {
                return $this->successResponse(
                    null,
                    ('logout success')
                );
            }

            return $this->errorResponse(
                ('not authenticated'),
                401
            );
        } catch (\Throwable $e) {
            return $this->errorResponse(
                ('auth server error'),
                500,
            );
        }
    }

    public function destroy(int $id)
    {
        $deleted = $this->deleteUser->execute($id);
        return $deleted ?
            $this->successResponse(null, 'User deleted successfully') :
            $this->errorResponse('Could not delete user', [], 500);
    }
    public function destroyProfile()
    {
        $id = Auth::user()->id;
        return $this->destroy($id);
    }
}
