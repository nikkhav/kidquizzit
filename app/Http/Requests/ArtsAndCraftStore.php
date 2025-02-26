<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtsAndCraftStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
}
