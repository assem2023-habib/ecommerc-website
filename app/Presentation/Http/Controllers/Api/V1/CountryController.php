<?php

namespace App\Presentation\Http\Controllers\Api\V1;

use App\Application\UseCases\Country\{CreateCountryUseCase, UpdateCountryUseCase, GetCountryUseCase, DeleteCountryUseCase};
use App\Domain\Entities\CountryEntity;
use App\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Country\StoreCountryRequest;
use App\Presentation\Http\Requests\Country\UpdateCountryRequest;
use App\Presentation\Http\Resources\CountryResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly GetCountryUseCase $getCountry,
        private readonly CreateCountryUseCase $createCountry,
        private readonly UpdateCountryUseCase $updateCountry,
        private readonly DeleteCountryUseCase $deleteCountry,
    ) {}

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $countries = $this->getCountry->paginate($perPage);
        return $this->successResponse(
            CountryResource::collection($countries),
            'Countries fetched successfully',
        );
    }

    public function show(int $id)
    {
        $country = $this->getCountry->find($id);
        if (!$country) {
            return $this->errorResponse('Country not found', 404);
        }
        return $this->successResponse(
            new CountryResource($country),
            'Country fetched successfully'
        );
    }

    public function store(StoreCountryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $entity = new CountryEntity(
            id: null,
            country_name: $validated['country_name'],
            country_code: $validated['country_code'],
        );
        $country = $this->createCountry->execute($entity);
        return $this->successResponse(
            new CountryResource($country),
            'Country created successfully',
            201
        );
    }

    public function update(UpdateCountryRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $entity = new CountryEntity(
            id: $id,
            country_name: $validated['country_name'],
            country_code: $validated['country_code'],
        );
        $country = $this->updateCountry->execute($entity);
        return $this->successResponse(
            new CountryResource($country),
            'Country updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->deleteCountry->execute($id);
        if (!$deleted) {
            return $this->errorResponse('Country not found', 404);
        }
        return $this->successResponse(
            null,
            'Country deleted successfully'
        );
    }

    public function findByCode(string $code)
    {
        $country = $this->getCountry->findByCode($code);
        if (!$country) {
            return $this->errorResponse('Country not found', 404);
        }
        return $this->successResponse(
            new CountryResource($country),
            'Country fetched successfully'
        );
    }
}
