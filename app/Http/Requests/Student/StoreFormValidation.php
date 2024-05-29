<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email',
            'mobile' => 'required|numeric|digits:10|starts_with:98,97',
            'current_address' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,webp|max:1024',
            'dob' => 'nullable',
        ];
    }
}
