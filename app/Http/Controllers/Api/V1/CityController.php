<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Infrastructure\Persistence\Eloquent\Models\City as ModelsCity;

class CityController extends ModelsCity {}
