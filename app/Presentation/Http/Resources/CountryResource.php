<?php

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    public function __construct($resource)
    {
        // If resource is an array, convert it to CountryEntity
        if (is_array($resource)) {
            $resource = \App\Domain\Entities\CountryEntity::fromArray($resource);
        }
        // If resource is an Eloquent model, use it directly
        elseif (is_object($resource) && method_exists($resource, 'toArray')) {
            // Keep as Eloquent model for snake_case properties
        }

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'country_name' => $this->country_name,
            'country_code' => $this->country_code,
        ];
    }
}
