<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffPostRequest extends FormRequest
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
            'firstname' => 'bail|required|string',
            'lastname' => 'required|string',
            'email' => 'required|unique:staff,email|string',
            'age' => 'numeric|digits:2',
            'phone_number' => 'numeric|digits:10',
        ];
    }
}
