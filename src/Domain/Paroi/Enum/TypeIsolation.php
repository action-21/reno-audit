<?php

namespace App\Domain\Paroi\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeIsolation: int implements Enum
{
    case INCONNU = 1;
    case NON_ISOLE = 2;
    case ITI = 3;
    case ITE = 4;
    case ITR = 5;
    case ITI_ITE = 6;
    case ITI_ITR = 7;
    case ITE_ITR = 8;
    case ISOLE_TYPE_INCONNU = 9;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::INCONNU => 'Inconnu',
            self::NON_ISOLE => 'Non isolé',
            self::ITI => 'ITI',
            self::ITE => 'ITE',
            self::ITR => 'ITR',
            self::ITI_ITE => 'ITI + ITE',
            self::ITI_ITR => 'ITI + ITR',
            self::ITE_ITR => 'ITE + ITR',
            self::ISOLE_TYPE_INCONNU => 'Isolé mais type d\'isolation inconnu'
        };
    }

    public function inconnu(): bool
    {
        return $this === self::INCONNU;
    }

    public function est_isole(): ?bool
    {
        return match ($this) {
            self::INCONNU => null,
            self::NON_ISOLE => false,
            default => true
        };
    }
}
