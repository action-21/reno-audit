<?php

namespace App\Domain\PlancherBas\Enum;

use App\Domain\Common\Enum\Enum;

/**
 * TODO: renomage des énumérations
 */
enum TypePlancherBas: int implements Enum
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

    /**
     * @deprecated
     */
    case ID_13 = 13;

    /** @inheritdoc */
    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Inconnu',
            self::ID_02 => 'Plancher avec ou sans remplissage',
            self::ID_03 => 'Plancher entre solives métalliques avec ou sans remplissage',
            self::ID_04 => 'Plancher entre solives bois avec ou sans remplissage',
            self::ID_05 => 'Plancher bois sur solives métalliques',
            self::ID_06 => 'Bardeaux et remplissage',
            self::ID_07 => 'Voutains sur solives métalliques',
            self::ID_08 => 'Voutains en briques ou moellons',
            self::ID_09 => 'Dalle béton',
            self::ID_10 => 'Plancher bois sur solives bois',
            self::ID_11 => 'Plancher lourd type entrevous terre-cuite, poutrelles béton',
            self::ID_12 => 'Plancher à entrevous isolant',
            self::ID_13 => 'Autre type de plancher non répertorié',
        };
    }

    /**
     * Upb0 - Coefficient de transmission thermique du plancher bas non isolé (W/(m².K))
     * 
     * @see §3.2.2.2
     */
    public function upb0(): float
    {
        return match($this)
        {
            self::ID_01 => 2,
            self::ID_02 => 1.45,
            self::ID_03 => 1.45,
            self::ID_04 => 1.1,
            self::ID_05 => 1.6,
            self::ID_06 => 1.1,
            self::ID_07 => 1.75,
            self::ID_08 => 0.8,
            self::ID_09 => 2,
            self::ID_10 => 1.6,
            self::ID_11 => 2,
            self::ID_12 => 0.45
        };
    }
}
