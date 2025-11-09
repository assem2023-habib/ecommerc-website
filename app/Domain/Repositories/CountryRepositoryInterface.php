<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\CountryEntity;

interface CountryRepositoryInterface
{
    public function all(): array;
    public function paginate(int $perPage = 10);
    public function find(int $id): ?CountryEntity;
    public function findByCode(string $code): ?CountryEntity;
    public function create(CountryEntity $country): CountryEntity;
    public function update(CountryEntity $country): CountryEntity;
    public function delete(int $id): bool;
}
