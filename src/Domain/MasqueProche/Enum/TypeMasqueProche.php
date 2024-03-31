<?php

namespace App\Domain\MasqueProche\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeMasqueProche: int implements Enum
{
    case FOND_BALCON_OU_FOND_ET_FLANC_LOGGIAS = 1;
    case BALCON_OU_AUVENT = 2;
    case PAROI_LATERALE_SANS_OBSTACLE_AU_SUD = 3;
    case PAROI_LATERALE_AVEC_OBSTACLE_AU_SUD = 4;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::FOND_BALCON_OU_FOND_ET_FLANC_LOGGIAS => 'Baie en fond de balcon ou fond et flanc de loggias',
            self::BALCON_OU_AUVENT => 'Baie sous un balcon ou auvent',
            self::PAROI_LATERALE_SANS_OBSTACLE_AU_SUD => 'Baie masquée par une paroi latérale avec un retour qui ne fait pas obstacle au Sud',
            self::PAROI_LATERALE_AVEC_OBSTACLE_AU_SUD => 'Baie masquée par une paroi latérale avec un retour qui fait obstacle au Sud'
        };
    }
}
