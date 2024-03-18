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
            'name' => 'required',
            'email' => [
                'nullable',
                Rule::unique('clients', 'email')->ignore($this->client),
            ],
            'mobile' => 'required',
            'password' => 'nullable|confirmed|min:6',
            'national_id_number' => [
                'nullable','min:6','max:18','regex:/[0-9]{6,18}/',
                Rule::unique('clients', 'national_id_number')->ignore($this->client),
            ],
        ];
    }
}
