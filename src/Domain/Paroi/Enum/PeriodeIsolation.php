<?php

namespace App\Domain\Paroi\Enum;

use App\Domain\Common\Enum\Enum;

enum PeriodeIsolation: int implements Enum
{
    case AVANT_1948 = 1;
    case ENTRE_1948_ET_1974 = 2;
    case ENTRE_1975_ET_1977 = 3;
    case ENTRE_1978_ET_1982 = 4;
    case ENTRE_1983_ET_1988 = 5;
    case ENTRE_1989_ET_2000 = 6;
    case ENTRE_2001_ET_2005 = 7;
    case ENTRE_2006_ET_2012 = 8;
    case ENTRE_2013_ET_2021 = 9;
    case APRES_2021 = 10;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::AVANT_1948 => 'Avant 1948',
            self::ENTRE_1948_ET_1974 => 'Entre 1948 et 1974',
            self::ENTRE_1975_ET_1977 => 'Entre 1975 et 1977',
            self::ENTRE_1978_ET_1982 => 'Entre 1978 et 1982',
            self::ENTRE_1983_ET_1988 => 'Entre 1983 et 1988',
            self::ENTRE_1989_ET_2000 => 'Entre 1989 et 2000',
            self::ENTRE_2001_ET_2005 => 'Entre 2001 et 2005',
            self::ENTRE_2006_ET_2012 => 'Entre 2006 et 2012',
            self::ENTRE_2013_ET_2021 => 'Entre 2013 et 2021',
            self::APRES_2021 => 'Après 2021'
        };
    }
}
