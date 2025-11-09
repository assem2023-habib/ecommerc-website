<?php

namespace App\Presentation\Http\Controllers\Api\V1;

use App\Application\UseCases\City\{CreateCityUseCase, UpdateCityUseCase, GetCityUseCase, DeleteCityUseCase};
use App\Domain\Entities\CityEntity;
use App\Http\Controllers\Controller;
use App\Presentation\Http\Requests\City\StoreCityRequest;
use App\Presentation\Http\Requests\City\UpdateCityRequest;
use App\Presentation\Http\Resources\CityResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly GetCityUseCase $getCity,
        private readonly CreateCityUseCase $createCity,
        private readonly UpdateCityUseCase $updateCity,
        private readonly DeleteCityUseCase $deleteCity,
    ) {}

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $cities = $this->getCity->paginate($perPage);
        return $this->successResponse(
            CityResource::collection($cities),
            'Cities fetched successfully',
        );
    }

    public function show(int $id)
    {
        $city = $this->getCity->find($id);
        if (!$city) {
            return $this->errorResponse('City not found', 404);
        }
        return $this->successResponse(
            new CityResource($city),
            'City fetched successfully'
        );
    }

    public function store(StoreCityRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $entity = new CityEntity(
            id: null,
            city_name: $validated['city_name'],
            country_id: $validated['country_id'],
        );
        $city = $this->createCity->execute($entity);
        return $this->successResponse(
            new CityResource($city),
            'City created successfully',
            201
        );
    }

    public function update(UpdateCityRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $entity = new CityEntity(
            id: $id,
            city_name: $validated['city_name'],
            country_id: $validated['country_id'],
        );
        $city = $this->updateCity->execute($entity);
        return $this->successResponse(
            new CityResource($city),
            'City updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->deleteCity->execute($id);
        if (!$deleted) {
            return $this->errorResponse('City not found', 404);
        }
        return $this->successResponse(
            null,
            'City deleted successfully'
        );
    }

    public function findByCountry(int $countryId)
    {
        $cities = $this->getCity->findByCountry($countryId);
        return $this->successResponse(
            CityResource::collection($cities),
            'Cities fetched successfully'
        );
    }
}
