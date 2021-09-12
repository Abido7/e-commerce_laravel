<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateProduct extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'name_en' => 'required|string|min:3|max:100',
            'name_ar' => 'required|string|min:3|max:150',
            'desc_en' => 'required|string|min:10|max:1000',
            'desc_ar' => 'required|string|min:10|max:1000',
            'pices_no' => 'required|min:1',
            'price' => 'required|numeric',
        ];
    }
}