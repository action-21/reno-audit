<?php

namespace App\Domain\Audit\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeEnergie: int implements Enum
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

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Électricité',
            self::ID_02 => 'Gaz naturel',
            self::ID_03 => 'Fioul domestique',
            self::ID_04 => 'Bois - Bûches',
            self::ID_05 => 'Bois - Granulés (pellets) ou briquettes',
            self::ID_06 => 'Bois - Plaquettes forestières',
            self::ID_07 => 'Bois - Plaquettes d\'industrie',
            self::ID_08 => 'Réseau de Chauffage urbain',
            self::ID_09 => 'Propane',
            self::ID_10 => 'Butane',
            self::ID_11 => 'Charbon',
            self::ID_12 => 'Électricité d\'origine renouvelable utilisée dans le bâtiment',
            self::ID_13 => 'GPL',
            self::ID_14 => 'Autre combustible fossile',
            self::ID_15 => 'Réseau de Froid Urbain',
        };
    }

    /**
     * Coefficient de conversion en PCI/PCS - Valeur pour "autre combustible fossile" non mentionnée dans la méthode officielle
     * 
     * @see §13.2.1.4
     */
    public function coefficient_conversion_pcs(): float
    {
        return match ($this) {
            self::ID_01 => 1,
            self::ID_02 => 1.11,
            self::ID_03 => 1.07,
            self::ID_04 => 1.08,
            self::ID_05 => 1.08,
            self::ID_06 => 1.08,
            self::ID_07 => 1.08,
            self::ID_08 => 1,
            self::ID_09 => 1.09,
            self::ID_10 => 1.09,
            self::ID_11 => 1.04,
            self::ID_12 => 1,
            self::ID_13 => 1.09,
            self::ID_14 => 1,
            self::ID_15 => 1,
        };
    }

    /**
     * Facteur de conversion en énergie primaire
     */
    public function facteur_energie_primaire(): float
    {
        return match ($this) {
            self::ID_01 => 2.3,
            default => 1
        };
    }
}
