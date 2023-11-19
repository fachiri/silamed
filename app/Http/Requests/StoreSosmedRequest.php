<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSosmedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sosmed' => 'required|unique:sosmeds,sosmed',
            'icon' => 'required',
            'name' => 'required',
            'link' => 'required',
        ];
    }
}
