<?php

namespace App\Application\UseCases\Country;

use App\Domain\Repositories\CountryRepositoryInterface;

class DeleteCountryUseCase
{
    public function __construct(
        private CountryRepositoryInterface $countryRepository
    ) {}

    public function execute(int $id): bool
    {
        return $this->countryRepository->delete($id);
    }
}
