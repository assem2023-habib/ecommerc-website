<?php

namespace App\Application\UseCases\City;

use App\Domain\Entities\CityEntity;
use App\Domain\Repositories\CityRepositoryInterface;

class UpdateCityUseCase
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {}

    public function execute(CityEntity $cityEntity): CityEntity
    {
        return $this->cityRepository->update($cityEntity);
    }
}
