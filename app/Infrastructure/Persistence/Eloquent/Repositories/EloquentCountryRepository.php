<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Entities\CountryEntity;
use App\Domain\Repositories\CountryRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\Country;

class EloquentCountryRepository implements CountryRepositoryInterface
{
    public function all(): array
    {
        return Country::all()
            ->map(fn($model) => $this->toEntity($model))
            ->toArray();
    }

    public function paginate(int $perPage = 10)
    {
        return Country::paginate($perPage);
    }

    public function find(int $id): ?CountryEntity
    {
        $country = Country::find($id);
        return $country ? $this->toEntity($country) : null;
    }

    public function findByCode(string $code): ?CountryEntity
    {
        $country = Country::where('country_code', $code)->first();
        return $country ? $this->toEntity($country) : null;
    }

    public function create(CountryEntity $country): CountryEntity
    {
        $model = Country::create($country->toArray());
        return $this->toEntity($model);
    }

    public function update(CountryEntity $country): CountryEntity
    {
        $model = Country::findOrFail($country->id);
        $model->update($country->toArray());
        return $this->toEntity($model);
    }

    public function delete(int $id): bool
    {
        $model = Country::find($id);
        return $model ? $model->delete() : false;
    }

    private function toEntity(Country $model): CountryEntity
    {
        return CountryEntity::fromArray($model->toArray());
    }
}
