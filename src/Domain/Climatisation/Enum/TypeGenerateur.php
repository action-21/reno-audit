<?php

namespace App\Domain\Climatisation\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeGenerateur: int implements Enum
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
    case ID_17 = 17;
    case ID_18 = 18;
    case ID_19 = 19;
    case ID_20 = 20;
    case ID_21 = 21;
    case ID_22 = 22;
    case ID_23 = 23;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'PAC air/air installée avant 2008',
            self::ID_02 => 'PAC air/air installée entre 2008 et 2014',
            self::ID_03 => 'PAC air/air installée à partir de 2015',
            self::ID_04 => 'PAC air/eau installée avant 2008',
            self::ID_05 => 'PAC air/eau installée entre 2008 et 2014',
            self::ID_06 => 'PAC air/eau installée entre 2015 et 2016',
            self::ID_07 => 'PAC air/eau installée après 2017',
            self::ID_08 => 'PAC eau/eau installée avant 2008',
            self::ID_09 => 'PAC eau/eau installée entre 2008 et 2014',
            self::ID_10 => 'PAC eau/eau installée entre 2015 et 2016',
            self::ID_11 => 'PAC eau/eau installée après 2017',
            self::ID_12 => 'PAC eau glycolée/eau installée avant 2008',
            self::ID_13 => 'PAC eau glycolée/eau installée entre 2008 et 2014',
            self::ID_14 => 'PAC eau glycolée/eau installée entre 2015 et 2016',
            self::ID_15 => 'PAC eau glycolée/eau installée après 2017',
            self::ID_16 => 'PAC géothermique installée avant 2008',
            self::ID_17 => 'PAC géothermique installée entre 2008 et 2014',
            self::ID_18 => 'PAC géothermique installée entre 2015 et 2016',
            self::ID_19 => 'PAC géothermique installée après 2017',
            self::ID_20 => 'autre système thermodynamique électrique',
            self::ID_21 => 'autre système thermodynamique gaz',
            self::ID_22 => 'autre système de refroidissement',
            self::ID_23 => 'réseau de froid urbain'
        };
    }
}
