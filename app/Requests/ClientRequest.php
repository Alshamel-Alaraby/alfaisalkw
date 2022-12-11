<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
                'nullable',
                Rule::unique('clients', 'email')->ignore($this->client)
                ],
            'mobile'=>'required',
            'password'=>'nullable|confirmed|min:6'
        ];
    }
}
