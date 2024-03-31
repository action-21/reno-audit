<?php

namespace App\Domain\Photovolotaique\Enum;

use App\Domain\Common\Enum\Enum;

enum Orientation: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;
    case ID_05 = 5;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Est',
            self::ID_02 => 'Sud-Est',
            self::ID_03 => 'Sud',
            self::ID_04 => 'Sud-Ouest',
            self::ID_05 => 'Ouest'
        };
    }
}
