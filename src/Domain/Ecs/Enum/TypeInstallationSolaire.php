<?php

namespace App\Domain\Ecs\Enum;

enum TypeInstallationSolaire: int
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Chauffage solaire (seul ou combiné)',
            self::ID_02 => 'ECS solaire seule sup 5 ans',
            self::ID_03 => 'ECS solaire seule inf 5 ans',
            self::ID_04 => 'Chauffage + ECS solaire'
        };
    }
}
