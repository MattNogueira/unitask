<?php

namespace App\Http\Requests\Disciplina;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDisciplinaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'professor' => ['required', 'string', 'max:255'],
            'horario' => ['required', 'date'],
        ];
    }
}
