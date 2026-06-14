<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'disciplina';

    protected $fillable = [
        'nome',
        'professor',
        'horario',
        'id_usuario',
    ];

    protected function casts(): array
    {
        return [
            'horario' => 'datetime',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function atividades()
    {
        return $this->hasMany(Atividade::class, 'id_disciplina');
    }
}
