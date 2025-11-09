<?php

namespace App\Application\UseCases\City;

use App\Domain\Repositories\CityRepositoryInterface;

class DeleteCityUseCase
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {}

    public function execute(int $id): bool
    {
        return $this->cityRepository->delete($id);
    }
}
