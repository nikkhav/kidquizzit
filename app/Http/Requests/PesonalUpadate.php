<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PesonalUpadate extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'password' => 'nullable|string|min:8|confirmed',
            'email' => 'required',
            'position_id' => 'required',
            'department_id' => 'required',
            'role_id' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
        ];
    }

    
    protected function failedValidation(Validator $validator)
    {
         throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

}
