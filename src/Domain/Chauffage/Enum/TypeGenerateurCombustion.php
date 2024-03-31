<?php

namespace App\Domain\Chauffage\Enum;

enum TypeGenerateurCombustion: int
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Chaudière murale installée avant 2005',
            self::ID_02 => 'Chaudière murale installée à partir de 2006',
            self::ID_03 => 'Chaudière au sol'
        };
    }
}
