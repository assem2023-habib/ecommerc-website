<?php

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function __construct($resource)
    {
        // If resource is an array, convert it to CityEntity
        if (is_array($resource)) {
            $resource = \App\Domain\Entities\CityEntity::fromArray($resource);
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
            'city_name' => $this->city_name,
            'country_id' => $this->country_id,
            'country' => $this->whenLoaded('country') ? new CountryResource($this->whenLoaded('country')) : null,
        ];
    }
}
