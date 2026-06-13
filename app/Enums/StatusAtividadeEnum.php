<?php

namespace App\Enums;

enum StatusAtividadeEnum: int
{
    case PENDENTE = 0;
    case ANDAMENTO = 1;
    case CONCLUIDA = 2;
    case ATRASADA = 3;

    public function label(): string
    {
        return match ($this) {
            self::PENDENTE => 'Pendente',
            self::ANDAMENTO => 'Em andamento',
            self::CONCLUIDA => 'Concluída',
            self::ATRASADA => 'Atrasada',
        };
    }
}
