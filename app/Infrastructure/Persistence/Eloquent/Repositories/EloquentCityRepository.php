<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Entities\CityEntity;
use App\Domain\Repositories\CityRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\City;

class EloquentCityRepository implements CityRepositoryInterface
{
    public function all(): array
    {
        return City::all()
            ->with('country')
            ->get()
            ->map(fn($model) => $this->toEntity($model))
            ->toArray();
    }

    public function paginate(int $perPage = 10)
    {
        return City::with('country')->paginate($perPage);
    }

    public function find(int $id): ?CityEntity
    {
        $city = City::find($id);
        if (!$city)
            return null;
        $city->load('country');
        return $this->toEntity($city);
    }

    public function findByCountry(int $countryId): array
    {
        return City::where('country_id', $countryId)
            ->with('country')
            ->get()
            ->map(fn($model) => $this->toEntity($model))
            ->toArray();
    }

    public function create(CityEntity $city): CityEntity
    {
        $model = City::create($city->toArray());
        $model->load('country');
        return $this->toEntity($model);
    }

    public function update(CityEntity $city): CityEntity
    {
        $model = City::findOrFail($city->id);
        $model->update($city->toArray());
        $model->load('country');
        return $this->toEntity($model);
    }

    public function delete(int $id): bool
    {
        $model = City::find($id);
        if (!$model)
            return false;
        $model->load('country');
        return  $model->delete();
    }

    private function toEntity(City $model): CityEntity
    {
        return CityEntity::fromArray($model->toArray());
    }
}
