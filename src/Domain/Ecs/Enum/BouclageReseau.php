<?php

namespace App\Domain\Ecs\Enum;

enum BouclageReseau: int
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
            self::ID_01 => 'Réseau d\'ECS non bouclé',
            self::ID_02 => 'Réseau d\'ECS bouclé',
            self::ID_03 => 'Réseau d\'ECS avec présence d\'un traceur chauffant'
        };
    }
}
