<?php

namespace App\Domain\Climatisation\Enum;

use App\Domain\Common\Enum\Enum;

enum PeriodeInstallation: int implements Enum
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
            self::ID_01 => 'Avant 2008',
            self::ID_02 => 'Entre 2008 et 2014',
            self::ID_03 => 'Après 2015'
        };
    }
}
