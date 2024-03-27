<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'release_year' => 'nullable',
            'length' => 'nullable',
            'description' => 'nullable',
            'rating' => 'nullable',
            'language_id' => 'required',
            'special_features' => 'nullable',
            'image' => 'nullable'
        ];
    }
}
