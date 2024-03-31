<?php

namespace App\Domain\Chauffage\Enum;

enum TypeDistribution: int
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
            self::ID_01 => 'Abscence de réseau de distribution (émission directe',
            self::ID_02 => 'Réseau aéraulique',
            self::ID_03 => 'Réseau collectif eau chaude haute température (≥ 65°C)',
            self::ID_04 => 'Réseau collectif eau chaude moyenne ou basse température (< 65°C)',
            self::ID_05 => 'Réseau individuel eau chaude moyenne ou basse température (< 65°C)',
            self::ID_06 => 'Réseau individuel eau chaude haute température (≥ 65°C)',
            self::ID_06 => 'Réseau par fluide frigorigène'
        };
    }
}
