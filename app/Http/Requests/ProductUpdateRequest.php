<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:40',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'category' => 'required',
            'subcategory' => 'required',
            'des' => 'required|string|min:12',
            'notification_quantity' => 'nullable|numeric|min:1',
            'discount' => 'nullable|numeric|min:5|max:70',
        ];
    }
}