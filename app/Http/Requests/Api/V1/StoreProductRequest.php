<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
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
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'description' => ['string', 'max:5000', 'min:10', 'nullable'],
            'user_id' => ['required',],
            'size'  => ['numeric', 'min:1', 'max:100'],
            'color' => ['in:red,green',],
            'price' => ['numeric', 'nullable', 'min:1', 'max:10000000000'],
        ];
    }
}
