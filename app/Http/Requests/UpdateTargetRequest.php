<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTargetRequest extends FormRequest
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

    public function messages(): array
    {
        return [
            'pengikut.required' => 'Kolom pengikut wajib diisi.',
            'pengikut.integer' => 'Kolom pengikut harus berupa angka.',
            'jangkauan.required' => 'Kolom jangkauan wajib diisi.',
            'jangkauan.integer' => 'Kolom jangkauan harus berupa angka.',
            'interaksi.required' => 'Kolom interaksi wajib diisi.',
            'interaksi.integer' => 'Kolom interaksi harus berupa angka.',
        ];
    }
}
