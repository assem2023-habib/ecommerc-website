<?php

namespace App\Presentation\Http\Requests\Country;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCountryRequest extends FormRequest
{
    use ApiResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country_name' => 'sometimes|string|max:255|unique:countries,country_name',
            'country_code' => 'sometimes|string|max:10|unique:countries,country_code',
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
            'country_name.string' => __('auth.country_name_string'),
            'country_name.max' => __('auth.country_name_max'),
            'country_name.unique' => __('auth.country_name_unique'),
            'country_code.string' => __('auth.country_code_string'),
            'country_code.max' => __('auth.country_code_max'),
            'country_code.unique' => __('auth.country_code_unique'),
        ];
    }
}
