<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSosmedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sosmed' => 'required',
            'icon' => 'required',
            'name' => 'required',
            'link' => 'required',
        ];
    }
}
