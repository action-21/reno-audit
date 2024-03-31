<?php

namespace App\Domain\Batiment\Enum;

use App\Domain\Common\Enum\Enum;

enum ClasseAltitude: int implements Enum
{
    case INFERIEUR_400 = 1;
    case ENTRE_400_ET_800 = 2;
    case SUPERIEUR_800 = 3;

    public static function from_altitude(int $altitude): self
    {
        return match (true) {
            $altitude < 400 => self::INFERIEUR_400,
            $altitude <= 800 => self::ENTRE_400_ET_800,
            $altitude > 800 => self::SUPERIEUR_800,
        };
    }

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::INFERIEUR_400 => 'Inférieur à 400m',
            self::ENTRE_400_ET_800 => 'Entre 400 et 800m',
            self::SUPERIEUR_800 => 'Supérieur à 800m',
        };
    }
}
