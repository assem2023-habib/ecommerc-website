<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\RegisterUserData;
use App\Application\DTOs\UpdateUserData;
use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\AuthRepositoryInterface;

class UpdateAdminUseCase
{
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {}

    public function execute(UpdateUserData $data, int $id): UserEntity
    {
        return $this->authRepository->updateAdmin($id, $data);
    }
}
