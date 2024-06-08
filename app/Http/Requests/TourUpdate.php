<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'city_id' => 'required|exists:cities,id',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string|max:255',
            'description1' => 'required|string',
            'description2' => 'required|string',
        ];
    }
}
