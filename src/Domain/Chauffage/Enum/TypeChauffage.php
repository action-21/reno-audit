<?php

namespace App\Domain\Chauffage\Enum;

enum TypeChauffage: int
{
    case ID_01 = 1;
    case ID_02 = 2;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Chauffage Divisé',
            self::ID_02 => 'Chauffage Central'
        };
    }
}
