<?php

namespace App\Http\Requests\Atividade;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class StoreAtividadeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'prazo' => ['required', 'date'],
            'prioridade' => ['required', 'integer', 'in:1,2,3'],
            'id_disciplina' => [
                'required',
                'integer',
                Rule::exists('disciplina', 'id')->where('id_usuario', $this->user()->id),
            ],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                if (! $this->filled('prazo')) {
                    return;
                }

                $timezone = 'America/Sao_Paulo';
                $value = (string) $this->input('prazo');
                try {
                    $deadline = Carbon::parse($value, $timezone);
                } catch (\Throwable) {
                    return;
                }
                $minimum = preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)
                    ? Carbon::today($timezone)
                    : Carbon::now($timezone);

                if ($deadline->lt($minimum)) {
                    $validator->errors()->add('prazo', 'A data de entrega não pode estar no passado.');
                }
            },
        ];
    }
}
