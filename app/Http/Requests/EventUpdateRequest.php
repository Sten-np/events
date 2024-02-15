<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'name' => 'string|min:5|max:100|required',
            'description' => 'string|min:10|max:255|required',
            'location' => 'string|min:5|max:100|required',
            'date' => 'date|required|after:today',
            'time' => 'date_format:H:i|required',
            'price' => 'string|required',
        ];
    }
}
