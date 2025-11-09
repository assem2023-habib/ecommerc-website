<?php

namespace App\Application\UseCases\Auth;

use App\Domain\Repositories\AuthRepositoryInterface;

class DeleteAdminUseCase
{
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {}

    public function execute(int $id): bool
    {
        return $this->authRepository->deleteAdmin($id);
    }
}
