<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUserRequest extends FormRequest
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
            'first_name'=>'required|alpha|max:100',
            'last_name'=>'required|alpha|max:100',
            'mobile'=>'required|numeric|unique:users',
            'email'=>'required|email|unique:users|max:100',
            'password'=>'required|confirmed|min:6',
        ];
    }
}
