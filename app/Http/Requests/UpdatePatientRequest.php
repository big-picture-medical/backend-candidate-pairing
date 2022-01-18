<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    /**
     * @return array<string, array<string>>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'string',
            ],
            'last_name' => [
                'string',
            ],
            'date_of_birth' => [
                'date',
            ],
            'email' => [
                'nullable',
                'email',
            ]
        ];
    }
}
