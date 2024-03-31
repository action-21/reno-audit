<?php

namespace App\Domain\MasqueLointain\Enum;

use App\Domain\Common\Enum\Enum;

enum Orientation: int implements Enum
{
    case SUD = 1;
    case NORD = 2;
    case EST = 3;
    case OUEST = 4;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::SUD => 'Sud',
            self::NORD => 'Nord',
            self::EST => 'Est',
            self::OUEST => 'Ouest',
        };
    }
}
