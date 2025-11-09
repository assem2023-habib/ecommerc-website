<?php

namespace App\Presentation\Http\Requests\Category;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCategoryRequest extends FormRequest
{
    use ApiResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'slug'        => ['required', 'string', 'unique:categories,slug'],
            'is_show'     => ['boolean', 'nullable'],
            'is_trend' => 'boolean|nullable',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse(
                __('category.validation_failed'),
                $validator->errors(),
                422
            )
        );
    }

    public function messages()
    {
        return [
            'name.required' => __('category.name_required'),
            'name.string' => __('category.name_string'),
            'name.max' => __('category.name_max'),
            'description.string' => __('category.description_string'),
            'slug.required' => __('category.slug_required'),
            'slug.string' => __('category.slug_string'),
            'slug.unique' => __('category.slug_unique'),
            'is_show.boolean' => __('category.is_show_boolean'),
            'is_trend.boolean' => __('category.is_trend_boolean'),
        ];
    }
}
