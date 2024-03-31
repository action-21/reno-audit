<?php

namespace App\Domain\Audit\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeUsage: int implements Enum
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
    case ID_16 = 16;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Chauffage',
            self::ID_02 => 'Eau Chaude sanitaire',
            self::ID_03 => 'Refroidissement',
            self::ID_04 => 'Eclairage',
            self::ID_05 => 'Bureautique',
            self::ID_06 => 'Ascenseur(s)',
            self::ID_07 => 'Autres usages',
            self::ID_08 => 'Production d\'électricité à demeure',
            self::ID_09 => 'Abonnements',
            self::ID_10 => 'Transports mécaniques',
            self::ID_11 => 'Chauffage et Eau chaude sanitaire',
            self::ID_12 => 'Périmètre de l\'usage inconnu',
            self::ID_13 => 'Chauffage, Eau chaude sanitaire et Climatisation',
            self::ID_14 => 'Chauffage et Climatisation',
            self::ID_15 => 'Eau Chaude Sanitaire et Climatisation',
            self::ID_16 => 'Auxiliaires et ventilation'
        };
    }

    /**
     * Usages couverts par le Diagnostic de Performance Energétique
     * 
     * @return self[]
     */
    public static function usages_dpe(): array
    {
        return [self::ID_01, self::ID_02, self::ID_03, self::ID_04, self::ID_16];
    }

    public static function chauffage(): static
    {
        return self::ID_01;
    }

    public static function ecs(): static
    {
        return self::ID_01;
    }

    public static function refroidissement(): static
    {
        return self::ID_01;
    }

    public static function eclairage(): static
    {
        return self::ID_01;
    }

    public static function auxiliaires_ventilation(): static
    {
        return self::ID_16;
    }
}
