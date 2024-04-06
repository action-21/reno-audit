<?php

namespace App\Domain\Porte\Enum;

use App\Domain\Common\Enum\Enum;

/**
 * Type de porte
 * 
 * TODO: renomage des enumérations
 */
enum TypePorte: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;
    case ID_05 = 5;
    case ID_06 = 6;
    case ID_07 = 7;
    case ID_08 = 8;
    case ID_09 = 9;
    case ID_10 = 10;
    case ID_11 = 11;
    case ID_12 = 12;
    case ID_13 = 13;
    case ID_14 = 14;
    case ID_15 = 15;
    /** @deprecated */
    case ID_16 = 16;

    /** @inheritdoc */
    public function id(): int
    {
        return $this->value;
    }

    /** @inheritdoc */
    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Porte simple en bois - Porte opaque pleine',
            self::ID_02 => 'Porte simple en bois - Porte avec moins de 30% de vitrage simple',
            self::ID_03 => 'Porte simple en bois - Porte avec 30-60% de vitrage simple',
            self::ID_04 => 'Porte simple en bois - Porte avec double vitrage',
            self::ID_05 => 'Porte simple en PVC - Porte opaque pleine',
            self::ID_06 => 'Porte simple en PVC - Porte avec moins de 30% de vitrage simple',
            self::ID_07 => 'Porte simple en PVC - Porte avec 30-60% de vitrage simple',
            self::ID_08 => 'Porte simple en PVC - Porte avec double vitrage',
            self::ID_09 => 'Porte simple en métal - Porte opaque pleine',
            self::ID_10 => 'Porte simple en métal - Porte avec vitrage simple',
            self::ID_11 => 'Porte simple en métal - Porte avec moins de 30% de double vitrage',
            self::ID_12 => 'Porte simple en métal - Porte avec 30-60% de double vitrage',
            self::ID_13 => 'Toute menuiserie - Porte opaque pleine isolée',
            self::ID_14 => 'Toute menuiserie - Porte précédée d\'un SAS',
            self::ID_15 => 'Toute menuiserie - Porte isolée avec double vitrage',
            self::ID_16 => 'autre type de porte'
        };
    }

    public function est_isole(): bool
    {
        return false;
    }
}
