<?php

namespace App\Application\UseCases\User;

use App\Domain\Repositories\UserRepositoryInterface;

class DeleteUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo
    ) {}
    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
