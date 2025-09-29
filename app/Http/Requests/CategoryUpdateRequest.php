<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'name' => 'required',
        ];

        if ($this->hasFile('img')) {
            $rules['img'] = 'image|mimes:jpeg,png,jpg|max:1024|dimensions:min_width=1000,min_height=350,max_width=1200,max_height=390';
        }

        return $rules;
    }
}
