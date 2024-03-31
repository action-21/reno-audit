<?php

namespace App\Domain\Chauffage\Enum;

enum PeriodeInstallationEmetteur: int
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
            self::ID_01 => 'Avant 1981',
            self::ID_02 => 'Entre 1981 et 2000',
            self::ID_03 => 'Après 2000'
        };
    }
}
