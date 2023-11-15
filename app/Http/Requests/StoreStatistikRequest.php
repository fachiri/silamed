<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatistikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sosmed_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required|numeric',
            'pengikut' => 'required|integer',
            'jangkauan' => 'required|integer',
            'interaksi' => 'required|integer'
        ];
    }
}
