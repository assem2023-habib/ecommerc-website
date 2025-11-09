<?php

namespace App\Application\UseCases\Auth;

use App\Domain\Repositories\AuthRepositoryInterface;

class PromoteToAdminUseCase
{
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {}

    public function execute(int $id): bool
    {
        return $this->authRepository->promoteToAdmin($id);
    }
}
