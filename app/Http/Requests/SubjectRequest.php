<?php

namespace App\Http\Requests;

class SubjectRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string",
            "department" => "required|string",
            "teacher_id" => "required|numeric",
            "is_active" => "required|boolean",
            "students" => "required|array",
            "students.*.id" => "required|numeric",
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => "Nome",
            "department" => "Departamento",
            "teacher_id" => "Professor",
            "students" => "Estudantes",
            "students.*.id" => "Estudante",
            "is_active" => "Ativo/Inativo",
        ];
    }
}
