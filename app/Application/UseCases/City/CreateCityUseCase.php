<?php

namespace App\Application\UseCases\City;

use App\Domain\Entities\CityEntity;
use App\Domain\Repositories\CityRepositoryInterface;

class CreateCityUseCase
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {}

    public function execute(CityEntity $cityEntity): CityEntity
    {
        return $this->cityRepository->create($cityEntity);
    }
}
