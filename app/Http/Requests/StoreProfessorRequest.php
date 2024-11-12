<?php

namespace App\Http\Requests;

class StoreProfessorRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string",
            "email" => "required|string|email|unique:users,email",
            "cpf" => "required|string|min:11|max:11",
            "specialization" => "required|string|max:10",
        ];
    }
}
