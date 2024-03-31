<?php

namespace App\Domain\PontThermique\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeLiaison: int implements Enum
{
    case PLANCHER_BAS_MUR = 1;
    case PLANCHER_INTERMEDIAIRE_MUR = 2;
    case PLANCHER_HAUT_MUR = 3;
    case REFEND_MUR = 4;
    case MENUISERIE_MUR = 5;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::PLANCHER_BAS_MUR => 'Plancher bas / Mur',
            self::PLANCHER_INTERMEDIAIRE_MUR => 'Plancher Intermédiaire lourd / Mur',
            self::PLANCHER_HAUT_MUR => 'Plancher haut lourd / Mur',
            self::REFEND_MUR => 'Refend / Mur',
            self::MENUISERIE_MUR => 'Menuiserie / Mur'
        };
    }
}
