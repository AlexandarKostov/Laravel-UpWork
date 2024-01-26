<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required', 'email',
            'short_bio' => 'required', 'min:150',
            'skill' => 'required', 'max:4',
            'academy' => 'required', 'max:1',
        ];
    }
}
