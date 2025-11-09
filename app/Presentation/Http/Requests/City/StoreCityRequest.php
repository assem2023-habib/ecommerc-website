<?php

namespace App\Presentation\Http\Requests\City;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCityRequest extends FormRequest
{
    use ApiResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city_name' => 'required|string|max:255|unique:cities,city_name',
            'country_id' => 'required|exists:countries,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse(
                __('auth.validation_failed'),
                $validator->errors(),
                422
            )
        );
    }

    public function messages()
    {
        return [
            'city_name.required' => __('auth.city_name_required'),
            'city_name.string' => __('auth.city_name_string'),
            'city_name.max' => __('auth.city_name_max'),
            'city_name.unique' => __('auth.city_name_unique'),
            'country_id.required' => __('auth.country_id_required'),
            'country_id.exists' => __('auth.country_id_exists'),
        ];
    }
}
