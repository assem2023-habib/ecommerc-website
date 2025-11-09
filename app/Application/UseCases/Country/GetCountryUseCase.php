<?php

namespace App\Application\UseCases\Country;

use App\Domain\Entities\CountryEntity;
use App\Domain\Repositories\CountryRepositoryInterface;

class GetCountryUseCase
{
    public function __construct(
        private CountryRepositoryInterface $countryRepository
    ) {}

    public function all(): array
    {
        return $this->countryRepository->all();
    }

    public function paginate(int $perPage = 10)
    {
        return $this->countryRepository->paginate($perPage);
    }

    public function find(int $id): ?CountryEntity
    {
        return $this->countryRepository->find($id);
    }

    public function findByCode(string $code): ?CountryEntity
    {
        return $this->countryRepository->findByCode($code);
    }
}
