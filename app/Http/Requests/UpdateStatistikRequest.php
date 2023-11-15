<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatistikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pengikut' => 'required|integer',
            'jangkauan' => 'required|integer',
            'interaksi' => 'required|integer'
        ];
    }
}
