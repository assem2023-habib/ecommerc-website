<?php

namespace App\Application\UseCases\City;

use App\Domain\Entities\CityEntity;
use App\Domain\Repositories\CityRepositoryInterface;

class GetCityUseCase
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {}

    public function all(): array
    {
        return $this->cityRepository->all();
    }

    public function paginate(int $perPage = 10)
    {
        return $this->cityRepository->paginate($perPage);
    }

    public function find(int $id): ?CityEntity
    {
        return $this->cityRepository->find($id);
    }

    public function findByCountry(int $countryId): array
    {
        return $this->cityRepository->findByCountry($countryId);
    }
}
