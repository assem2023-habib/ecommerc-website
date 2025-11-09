<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Repositories\AuthRepositoryInterface;
use App\Domain\Entities\UserEntity;
use App\Application\DTOs\RegisterUserData;
use App\Application\DTOs\LoginUserData;
use App\Application\DTOs\UpdateUserData;
use App\Infrastructure\Persistence\Eloquent\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(RegisterUserData $data): UserEntity
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'user_name' => $data->user_name,
            'password' => Hash::make($data->password),
            'phone' => $data->phone,
            'birthday' => $data->birthday,
            'gender' => $data->gender,
            'city_id' => $data->city_id,
        ]);

        $user->load('city');

        return UserEntity::fromArray($user->toArray());
    }

    public function login(LoginUserData $data): ?UserEntity
    {
        $user = User::where('email', $data->email)->first();

        if ($user && Hash::check($data->password, $user->password)) {
            $user->load('city');
            return UserEntity::fromArray($user->toArray());
        }

        return null;
    }
    public function loginAdmin(LoginUserData $data): ?UserEntity
    {
        $user = User::where('email', $data->email)->first();

        if ($user && Hash::check($data->password, $user->password) && $user->hasRole("admin")) {
            $user->load('city');
            return UserEntity::fromArray($user->toArray());
        }

        return null;
    }

    public function registerAdmin(RegisterUserData $data): UserEntity
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'user_name' => $data->user_name,
            'password' => Hash::make($data->password),
            'phone' => $data->phone,
            'birthday' => $data->birthday,
            'gender' => $data->gender,
            'city_id' => $data->city_id,
        ]);

        $user->assignRole('admin');

        $user->load('city');
        return UserEntity::fromArray($user->toArray());
    }

    public function updateAdmin(int $id, UpdateUserData $data): UserEntity
    {
        $user = User::find($id);
        if (!$user) {
            throw new \Exception('User not found');
        }

        $updateData = $data->toArray();
        if ($data->password) {
            $updateData['password'] = Hash::make($data->password);
        }

        $user->update($updateData);

        $user->load('city');
        return UserEntity::fromArray($user->toArray());
    }

    public function deleteAdmin(int $id): bool
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }

    public function promoteToAdmin(int $id): bool
    {
        $user = User::find($id);
        if ($user) {
            $user->assignRole('admin');
            return true;
        }
        return false;
    }
}
