<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|min:3|max:40',
            'img' => 'required|file|image|mimes:jpeg,jpg,png',
            'img_multiple' => 'required',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'category' => 'required',
            'subcategory' => 'required',
            'des' => 'required|string|min:12',
        ];

        if ($this->has('notification_quantity') && $this->notification_quantity) {
            $rules['notification_quantity'] = 'numeric|min:1';
        }

        if ($this->has('discount') && $this->discount) {
            $rules['discount'] = 'numeric|min:5|max:70';
        }

        return $rules;
    }
}