<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Postcategoryrequest extends FormRequest
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
            'parent'=>'required|numeric',
            'sections'=>'required|numeric',
            'categoryname'=>'unique:categories|required|string|max:50',
            'categoryimage'=>'nullable|image|max:1999',
            'categorydiscount'=>'required|numeric',
            'categorydescription'=>'nullable|string|max:1000',
            'categoryurl'=>'nullable|string|max:100',
            'metatitle'=>'nullable|string|max:255',
            'metadescription'=>'nullable|string|max:1000',
            'metakeyword'=>'nullable|string|max:255',
        ];
    }
}
