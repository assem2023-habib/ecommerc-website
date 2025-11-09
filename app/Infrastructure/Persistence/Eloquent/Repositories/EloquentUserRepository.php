<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Application\DTOs\UpdateUserData;
use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function find(int $id): ?UserEntity
    {
        $user = User::with('city')->find($id);
        return $user ? $this->mapToEntity($user) : null;
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return User::with('city')->paginate($perPage);
    }
    public function update(UpdateUserData $data): ?UserEntity
    {
        $user = User::find($data->id);
        if ($user) {
            $updateData = $data->toArray();
            if ($data->password) {
                $updateData['password'] = Hash::make($data->password);
            }
            $user->update($updateData);
            $user->load('city');
            return $this->mapToEntity($user);
        }
        return null;
    }
    public function delete(int $id): bool
    {
        return User::destroy($id) > 0;
    }

    private function mapToEntity(User $user): UserEntity
    {
        return UserEntity::fromArray($user->toArray());
    }
}
