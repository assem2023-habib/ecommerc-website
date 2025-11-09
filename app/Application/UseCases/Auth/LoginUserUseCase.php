<?php

namespace App\Application\UseCases\Auth;

use App\Domain\Repositories\AuthRepositoryInterface;
use App\Application\DTOs\LoginUserData;
use App\Domain\Entities\UserEntity;

class LoginUserUseCase
{
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {}

    public function execute(LoginUserData $data): ?UserEntity
    {
        return $this->authRepository->login($data);
    }
}
