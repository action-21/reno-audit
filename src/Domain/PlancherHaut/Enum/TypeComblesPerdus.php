<?php

namespace App\Domain\PlancherHaut\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeComblesPerdus: int implements Enum
{
    case COMBLE_FORTEMENT_VENTILE = 4;
    case COMBLE_FAIBLEMENT_VENTILE = 5;
    case COMBLE_TRES_FAIBLEMENT_VENTILE = 6;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::COMBLE_FORTEMENT_VENTILE => 'Comble fortement ventilé',
            self::COMBLE_FAIBLEMENT_VENTILE => 'Comble faiblement ventilé',
            self::COMBLE_TRES_FAIBLEMENT_VENTILE => 'Comble très faiblement ventilé',
        };
    }
}
