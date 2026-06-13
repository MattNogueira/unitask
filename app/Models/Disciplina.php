<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nome', 'professor', 'horario', 'id_usuario'])]
class Disciplina extends Model
{
    protected $table = 'disciplina';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function atividades()
    {
        return $this->hasMany(Atividade::class, 'id_disciplina');
    }
}
