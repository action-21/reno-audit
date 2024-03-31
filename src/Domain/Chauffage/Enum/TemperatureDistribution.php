<?php

namespace App\Domain\Chauffage\Enum;

enum TemperatureDistribution: int
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
            self::ID_01 => 'Abscence de réseau de distribution',
            self::ID_02 => 'Basse',
            self::ID_03 => 'Moyenne',
            self::ID_04 => 'Haute'
        };
    }
}
