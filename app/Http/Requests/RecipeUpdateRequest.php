<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'category' => 'required',
            'procedure' => 'required',
            'duration' => 'required|integer',
            'ingredients' => 'required',
            'image' => 'mimes:jpg,svg,png,jpeg',
        ];
    }
}
