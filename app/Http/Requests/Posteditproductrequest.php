<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Posteditproductrequest extends FormRequest
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
            'category'=>'required|numeric|',
            'brand'=>'required|numeric|',
            'productname'=>'required|string|max:255',
            'productcode'=>'required|regex:/^[\w-]*$/',
            'productcolor'=>'required|string|max:255',
            'productprice'=>'required|numeric',
            'productdiscount'=>'required|numeric',
            'productweight'=>'required|string|max:255',
            'productimage'=>'nullable|image|max:1999',
            'productdescription'=>'nullable|max:1000',
            'washcare'=>'nullable|string',
            'fabric'=>'nullable|string',
            'pattern'=>'nullable|string',
            'sleeve'=>'nullable|string',
            'fit'=>'nullable|string',
            'occassion'=>'nullable|string',
            'metattitle'=>'nullable|max:1000',
            'metadescription'=>'nullable|max:1000',
            'metakeyword'=>'nullable|max:1000', 
            'featured'=>'nullable', 
        ];
    }
}
