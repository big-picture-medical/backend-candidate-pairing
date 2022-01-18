<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
{
    /**
     * @return array<string, array<string>>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
            ],
            'last_name' => [
                'required',
                'string',
            ],
            'date_of_birth' => [
                'required',
                'date',
            ],
            'email' => [
                'nullable',
                'email',
            ],
        ];
    }
}
