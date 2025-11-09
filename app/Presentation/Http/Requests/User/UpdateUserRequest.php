<?php

namespace App\Presentation\Http\Requests\User;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
{
    use ApiResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'user_name' => 'sometimes|string|max:255|unique:users,user_name',
            'email' => 'sometimes|email|unique:users,email',
            'password' => 'sometimes|string|min:6',
            'city_id' => 'sometimes|exists:cities,id',
            'birthday' => 'sometimes|date',
            'gender' => 'sometimes|string',
            'phone' => 'sometimes|string|max:30',
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
            'name.string' => __('auth.name_string'),
            'name.max' => __('auth.name_max'),
            'user_name.string' => __('auth.user_name_string'),
            'user_name.max' => __('auth.user_name_max'),
            'user_name.unique' => __('auth.user_name_unique'),
            'email.email' => __('auth.email_email'),
            'email.unique' => __('auth.email_unique'),
            'password.min' => __('auth.password_min'),
            'city_id.exists' => __('auth.city_id_exists'),
            'birthday.date' => __('auth.birthday_date'),
            'gender.string' => __('auth.gender_string'),
            'phone.string' => __('auth.phone_string'),
            'phone.max' => __('auth.phone_max'),
        ];
    }
}
