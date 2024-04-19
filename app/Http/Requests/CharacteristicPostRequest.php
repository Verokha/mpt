<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacteristicPostRequest extends FormRequest
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
            'inputSchool' => 'string|required|max:509',
            'inputEndSchool' => 'numeric|required',
            'inputYearOfEntry' => 'numeric|required',
            'responsibilities' => 'string|required|max:509',
            'inputWhereNeeded' => 'string|required|max:254',
            'inputSecondName' => 'string|required|max:509',
            'inputFirstdName' => 'string|required|max:509',
            'inputPatronymic' => 'string|max:509|nullable',
            'inputSemester' => 'string|required|max:254',
            'inputGroup' => 'string|required|max:509',
            'inputYear' => 'date|required',
        ];
    }
}
