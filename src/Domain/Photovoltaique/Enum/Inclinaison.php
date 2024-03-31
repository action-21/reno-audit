<?php

namespace App\Domain\Photovolotaique\Enum;

use App\Domain\Common\Enum\Enum;

enum Inclinaison: int implements Enum
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
            self::ID_01 => 'Inférieur ou égal à 15°',
            self::ID_02 => 'Entre 15° et 45°',
            self::ID_03 => 'Entre 45° et 75',
            self::ID_04 => 'Supérieur à 75°'
        };
    }
}
