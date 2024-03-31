<?php

namespace App\Domain\Ecs\Enum;

enum TypeStockage: int
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
            self::ID_01 => 'Abscence de stockage d\'ECS (production instantanée)',
            self::ID_02 => 'Stockage indépendant de la production',
            self::ID_03 => 'Stockage intégré à la production'
        };
    }
}
