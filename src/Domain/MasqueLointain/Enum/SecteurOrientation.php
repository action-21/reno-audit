<?php

namespace App\Domain\MasqueLointain\Enum;

use App\Domain\Common\Enum\Enum;

enum SecteurOrientation: int implements Enum
{
    case LATERAL_SUD = 1;
    case LATERAL_NORD = 2;
    case CENTRAL_SUD = 3;
    case CENTRAL_NORD = 4;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::LATERAL_SUD => 'Secteur latéral vers le sud',
            self::LATERAL_NORD => 'Secteur latéral vers le nord',
            self::CENTRAL_SUD => 'Secteur central vers le sud',
            self::CENTRAL_NORD => 'Secteur central vers le nord',
        };
    }
}
