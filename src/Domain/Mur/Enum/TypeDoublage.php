<?php

namespace App\Domain\Mur\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeDoublage: int implements Enum
{
    case INCONNU = 1;
    case SANS_DOUBLAGE = 2;
    case INDETERMINE_OU_LAME_AIR_INFERIEUR_15MM = 3;
    case INDETERMINE_AVEC_LAME_AIR_SUPERIEUR_15MM = 4;
    case MATERIAUX_CONNU = 5;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::INCONNU => 'Inconnu',
            self::SANS_DOUBLAGE => 'Absence de doublage',
            self::INDETERMINE_OU_LAME_AIR_INFERIEUR_15MM => 'Doublage indéterminé ou lame d\'air inf 15 mm',
            self::INDETERMINE_AVEC_LAME_AIR_SUPERIEUR_15MM => 'Doublage indéterminé avec lame d\'air sup 15 mm',
            self::MATERIAUX_CONNU => 'Doublage connu (plâtre brique bois)'
        };
    }

    public function resistance_doublage(): float
    {
        return match ($this) {
            self::INCONNU => 0,
            self::SANS_DOUBLAGE => 0,
            self::INDETERMINE_OU_LAME_AIR_INFERIEUR_15MM => 0.1,
            self::INDETERMINE_AVEC_LAME_AIR_SUPERIEUR_15MM => 0.21,
            self::MATERIAUX_CONNU => 0.21
        };
    }
}
