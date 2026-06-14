<?php

namespace App\Models;

use App\Enums\PrioridadeAtividadeEnum;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusAtividadeEnum;

class Atividade extends Model
{
    protected $table = 'atividade';

    protected $fillable = [
        'titulo',
        'descricao',
        'prazo',
        'status',
        'prioridade',
        'id_disciplina',
    ];

    protected function casts(): array
    {
        return [
            'prazo' => 'datetime',
            'status' => 'integer',
            'prioridade' => 'integer',
        ];
    }

    // Relacionamentos

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'id_disciplina');
    }

    public function usuario()
    {
        return $this->disciplina->usuario();
    }

    // Attributes

    public function getStatusNameAttribute($value)
    {
        return StatusAtividadeEnum::tryFrom($value) ?? 'Desconhecido';
    }

    public function getPrioridadeNameAttribute($value)
    {
        return PrioridadeAtividadeEnum::tryFrom($value) ?? 'Desconhecida';
    }
}
