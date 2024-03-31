<?php

namespace App\Domain\Porte\Enum;

use App\Domain\Common\Enum\Enum;

enum TypePose: int implements Enum
{
    case NU_EXTERIEUR = 1;
    case NU_INTERIEUR = 2;
    case TUNNEL = 3;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::NU_EXTERIEUR => 'Nu Extérieur',
            self::NU_INTERIEUR => 'Nu intérieur',
            self::TUNNEL => 'Tunnel',
        };
    }
}
