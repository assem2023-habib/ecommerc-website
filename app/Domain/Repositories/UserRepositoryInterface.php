<?php

namespace App\Domain\Repositories;

use App\Application\DTOs\UpdateUserData;
use App\Domain\Entities\UserEntity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function find(int $id): ?UserEntity;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function update(UpdateUserData $user): ?UserEntity;
    public function delete(int $id): bool;
}
