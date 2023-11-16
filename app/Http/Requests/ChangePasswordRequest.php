<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required|current_password',
            'new_password' => 'required',
            'repeat_new_password' => 'required|same:new_password'
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Kolom <b>Password Lama</b> wajib diisi.',
            'old_password.current_password' => '<b>Password Lama</b> tidak valid.',
            'new_password.required' => 'Kolom <b>Password Baru</b> wajib diisi.',
            'repeat_new_password.required' => 'Kolom <b>Ulangi Password Baru</b> wajib diisi.',
            'repeat_new_password.same' => '<b>Ulangi Password Baru</b> harus sama dengan <b>Password Baru</b>.',
        ];
    }
}
