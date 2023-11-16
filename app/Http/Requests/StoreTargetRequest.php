<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTargetRequest extends FormRequest
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
            'interaksi' => 'required|integer',
            'bulan' => 'required',
            'tahun' => 'required',
            'sosmed_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'sosmed_id.required' => 'Kolom media sosial wajib diisi.',
            'bulan.required' => 'Kolom bulan wajib diisi.',
            'tahun.required' => 'Kolom tahun wajib diisi.',
            'pengikut.required' => 'Kolom pengikut wajib diisi.',
            'pengikut.integer' => 'Kolom pengikut harus berupa angka.',
            'jangkauan.required' => 'Kolom jangkauan wajib diisi.',
            'jangkauan.integer' => 'Kolom jangkauan harus berupa angka.',
            'interaksi.required' => 'Kolom interaksi wajib diisi.',
            'interaksi.integer' => 'Kolom interaksi harus berupa angka.',
        ];
    }
}
