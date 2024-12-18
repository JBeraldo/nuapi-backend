<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'string|email|required',
            'password' => 'string|required',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'E-mail',
            'password' => 'Senha',
        ];
    }
}
