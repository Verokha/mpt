<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateStudyPostRequest extends FormRequest
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
            'typeDoc' => 'numeric|required',
            'inputSecondName' => 'string|required|max:509',
            'inputFirstdName' => 'string|required|max:509',
            'inputPatronymic' => 'string|max:509|nullable',
            'inputGroup' => 'string|required|max:509',
        ];
    }
}
