<?php

namespace App\Domain\PlancherHaut\Enum;

use App\Domain\Common\Enum\Enum;

/**
 * Type de plancher haut
 * 
 * TODO: renomage des énumérations
 */
enum TypePlancherHaut: int implements Enum
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
    case ID_16 = 16;
    /** @deprecated */
    case ID_15 = 15;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Inconnu',
            self::ID_02 => 'Plafond avec ou sans remplissage',
            self::ID_03 => 'Plafond entre solives métalliques avec ou sans remplissage',
            self::ID_04 => 'Plafond entre solives bois avec ou sans remplissage',
            self::ID_05 => 'Plafond bois sur solives métalliques',
            self::ID_06 => 'Plafond bois sous solives métalliques',
            self::ID_07 => 'Bardeaux et remplissage',
            self::ID_08 => 'Dalle béton',
            self::ID_09 => 'Plafond bois sur solives bois',
            self::ID_10 => 'Plafond bois sous solives bois',
            self::ID_11 => 'Plafond lourd type entrevous terre-cuite, poutrelles béton',
            self::ID_12 => 'Combles aménagés sous rampant',
            self::ID_13 => 'Toiture en chaume',
            self::ID_14 => 'Plafond en plaque de plâtre',
            self::ID_15 => 'Autre type de plafond non répertorié',
            self::ID_16 => 'Toitures en Bac acier',
        };
    }

    /**
     * Le type de plancher haut est compatible avec une 5ème façade
     */
    public function facade(): bool
    {
        return match ($this) {
            self::ID_12 => true,
            self::ID_13 => true,
            self::ID_16 => true,
            default => false,
        };
    }
}
