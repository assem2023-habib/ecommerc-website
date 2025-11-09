<?php

namespace App\Application\UseCases\Auth;

use App\Domain\Repositories\AuthRepositoryInterface;
use App\Application\DTOs\RegisterUserData;
use App\Domain\Entities\UserEntity;

class RegisterUserUseCase
{
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {}

    public function execute(RegisterUserData $data): UserEntity
    {
        return $this->authRepository->register($data);
    }
}
