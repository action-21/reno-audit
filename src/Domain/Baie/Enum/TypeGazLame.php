<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeGazLame: int implements Enum
{
    case AIR = 1;
    case ARGON_KRYPTON = 2;
    case INCONNU = 3;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::AIR => 'Air',
            self::ARGON_KRYPTON => 'Argon ou krypton',
            self::INCONNU => 'Inconnu'
        };
    }
}
