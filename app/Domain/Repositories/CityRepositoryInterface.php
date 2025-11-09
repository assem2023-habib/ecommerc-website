<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\CityEntity;

interface CityRepositoryInterface
{
    public function all(): array;
    public function paginate(int $perPage = 10);
    public function find(int $id): ?CityEntity;
    public function findByCountry(int $countryId): array;
    public function create(CityEntity $city): CityEntity;
    public function update(CityEntity $city): CityEntity;
    public function delete(int $id): bool;
}
