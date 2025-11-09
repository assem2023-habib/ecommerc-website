<?php

namespace App\Presentation\Http\Requests\User;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAdminUserRequest extends FormRequest
{
    use ApiResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'city_id' => 'required|exists:cities,id',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string',
            'phone' => 'nullable|string|max:30',
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
            'name.required' => __('auth.name_required'),
            'user_name.required' => __('auth.user_name_required'),
            'user_name.unique' => __('auth.user_name_unique'),
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_email'),
            'email.unique' => __('auth.email_unique'),
            'password.required' => __('auth.password_required'),
            'password.confirmed' => __('auth.password_confirmed'),
            'city_id.required' => __('auth.city_id_required'),
            'city_id.exists' => __('auth.city_id_exists'),
        ];
    }
}
