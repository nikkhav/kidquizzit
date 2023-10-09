<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class TaskUpdate extends FormRequest
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
            // 'id' => 'required',
            'title' => 'required',
            'customer_id' => 'required',
            // 'start' => 'required|date',
            // 'start' => 'required',
            'users_id' => 'required|array',
            'priority_id' => 'required',
            'department_id' => 'required',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
    throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
