<?php

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function __construct($resource)
    {
        // If resource is an array, convert it to UserEntity
        if (is_array($resource)) {
            $resource = \App\Domain\Entities\UserEntity::fromArray($resource);
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
            'name' => $this->name,
            'email' => $this->email,
            'user_name' => $this->user_name,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'city_id' => $this->city_id,
            'city' => $this->city ?? [],
        ];
    }
}
