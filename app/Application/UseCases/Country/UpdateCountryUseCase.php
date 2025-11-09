<?php

namespace App\Application\UseCases\Country;

use App\Domain\Entities\CountryEntity;
use App\Domain\Repositories\CountryRepositoryInterface;

class UpdateCountryUseCase
{
    public function __construct(
        private CountryRepositoryInterface $countryRepository
    ) {}

    public function execute(CountryEntity $countryEntity): CountryEntity
    {
        return $this->countryRepository->update($countryEntity);
    }
}
