<?php

namespace App\Domain\Common\Enum;

use App\Domain\Common\Enum\Enum;

enum Mois: int implements Enum
{
    case JANVIER = 1;
    case FEVRIER = 2;
    case MARS = 3;
    case AVRIL = 4;
    case MAI = 5;
    case JUIN = 6;
    case JUILLET = 7;
    case AOUT = 8;
    case SEPTEMBRE = 9;
    case OCTOBRE = 10;
    case NOVEMBRE = 11;
    case DECEMBRE = 12;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::JANVIER => 'Janvier',
            self::FEVRIER => 'Février',
            self::MARS => 'Mars',
            self::AVRIL => 'Avril',
            self::MAI => 'Mai',
            self::JUIN => 'Juin',
            self::JUILLET => 'Juillet',
            self::AOUT => 'Août',
            self::SEPTEMBRE => 'Septembre',
            self::OCTOBRE => 'Octobre',
            self::NOVEMBRE => 'Novembre',
            self::DECEMBRE => 'Décembre',
        };
    }

    /**
     * Nj - Nombre de jours d’occupation sur le mois j
     */
    public function nj(): int
    {
        return match ($this) {
            self::JANVIER => 31,
            self::FEVRIER => 28,
            self::MARS => 31,
            self::AVRIL => 30,
            self::MAI => 31,
            self::JUIN => 30,
            self::JUILLET => 31,
            self::AOUT => 31,
            self::SEPTEMBRE => 30,
            self::OCTOBRE => 31,
            self::NOVEMBRE => 30,
            self::DECEMBRE => 24,
        };
    }
}
