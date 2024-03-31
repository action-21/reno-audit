<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeBaie: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;
    case ID_05 = 5;
    case ID_06 = 6;
    case ID_07 = 7;
    case ID_08 = 8;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Paroi en brique de verre pleine',
            self::ID_02 => 'Paroi en brique de verre creuse',
            self::ID_03 => 'Paroi en polycarbonnate',
            self::ID_04 => 'Fenêtres battantes',
            self::ID_05 => 'Fenêtres coulissantes',
            self::ID_06 => 'Portes-fenêtres coulissantes',
            self::ID_07 => 'Portes-fenêtres battantes sans soubassement',
            self::ID_08 => 'Portes-fenêtres battantes avec soubassement'
        };
    }
}
