<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UserEntity;
use App\Application\DTOs\RegisterUserData;
use App\Application\DTOs\LoginUserData;
use App\Application\DTOs\UpdateUserData;

interface AuthRepositoryInterface
{
    public function register(RegisterUserData $data): UserEntity;
    public function login(LoginUserData $data): ?UserEntity;
    public function loginAdmin(LoginUserData $data): ?UserEntity;
    public function registerAdmin(RegisterUserData $data): UserEntity;
    public function updateAdmin(int $id, UpdateUserData  $data): UserEntity;
    public function deleteAdmin(int $id): bool;
    public function promoteToAdmin(int $id): bool;
}
