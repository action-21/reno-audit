<?php

namespace App\Domain\Chauffage\Enum;

enum UsageGenerateur: int
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
            self::ID_01 => 'Chauffage',
            self::ID_02 => 'ECS',
            self::ID_03 => 'Chauffage + ECS'
        };
    }
}
