<?php

namespace App\Domain\Chauffage\Enum;

enum EquipementIntermittence: int
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;
    case ID_05 = 5;
    case ID_06 = 6;
    case ID_07 = 7;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Absent',
            self::ID_02 => 'Central sans minimum de température',
            self::ID_03 => 'Central avec minimum de température',
            self::ID_04 => 'Par pièce avec minimum de température',
            self::ID_05 => 'Par pièce avec minimum de température et détection de présence',
            self::ID_06 => 'Central collectif',
            self::ID_07 => 'Central collectif avec détection de présence'
        };
    }
}
