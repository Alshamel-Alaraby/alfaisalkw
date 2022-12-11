<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>[
                'required',
                Rule::unique('users', 'email')->ignore($this->user)
                ],
            'password'=>'nullable|confirmed|min:6'
        ];
    }
}
