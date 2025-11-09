<?php

namespace App\Presentation\Http\Requests\Products;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProductRequestRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'short_description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'category_id' => 'sometimes|integer|exists:categories,id',
            'is_show' => 'sometimes|boolean',
            'images' => 'nullable|array',
            'images.*' => 'file|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse(
                __('product.validation_failed'),
                $validator->errors(),
                422
            )
        );
    }

    public function messages()
    {
        return [
            'name.string' => __('product.name_string'),
            'name.max' => __('product.name_max'),
            'description.string' => __('product.description_string'),
            'short_description.string' => __('product.short_description_string'),
            'price.numeric' => __('product.price_numeric'),
            'stock.integer' => __('product.stock_integer'),
            'category_id.integer' => __('product.category_id_integer'),
            'category_id.exists' => __('product.category_id_exists'),
            'is_show.boolean' => __('product.is_show_boolean'),
        ];
    }
}
