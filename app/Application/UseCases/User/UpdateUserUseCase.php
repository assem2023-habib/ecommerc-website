<?php

namespace App\Application\UseCases\User;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\DTOs\UpdateUserData;
use App\Domain\Entities\UserEntity;

class UpdateUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(UpdateUserData $data): ?UserEntity
    {
        return $this->userRepository->update($data);
    }
}
