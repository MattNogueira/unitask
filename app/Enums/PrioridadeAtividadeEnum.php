<?php

namespace App\Enums;

enum PrioridadeAtividadeEnum : int
{
    case BAIXA = 1;
    case MEDIA = 2;
    case ALTA = 3;

    public function label(): string
    {
        return match ($this) {
            self::BAIXA => 'Baixa',
            self::MEDIA => 'Média',
            self::ALTA => 'Alta',
        };
    }
}
