<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Infrastructure\Persistence\Eloquent\Models\Country as ModelsCountry;

class CountryController extends ModelsCountry {}
