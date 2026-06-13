<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

#[Fillable(['nome', 'email', 'senha'])]
#[Hidden(['senha', 'remember_token'])]
class Usuario extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UsuarioFactory> */
    use HasFactory, Notifiable;

    protected $table = 'usuario';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    // Relacionamentos

    public function disciplinas() : HasMany
    {
        return $this->hasMany(Disciplina::class, 'id_usuario');
    }

    public function tarefas() : Collection
    {
        return $this->disciplinas->flatMap(function ($disciplina) {
            return $disciplina->atividades;
        });
    }
}
