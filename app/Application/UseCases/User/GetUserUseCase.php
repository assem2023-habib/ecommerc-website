<?php

namespace App\Application\UseCases\User;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserRepositoryInterface;

class GetUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo
    ) {}
    public function paginate(int $perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }
    public function find(int $id): ?UserEntity
    {
        return $this->repo->find($id);
    }
}
