<?php

namespace App\Domain\Chauffage\Enum;

enum TypeRegulation: int
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
            self::ID_01 => 'Sans régulation pièce par pièce',
            self::ID_02 => 'Avec régulation pièce par pièce'
        };
    }

    /**
     * Présence d'une régulation
     */
    public function regulation(): bool
    {
        return $this === self::ID_02;
    }
}
