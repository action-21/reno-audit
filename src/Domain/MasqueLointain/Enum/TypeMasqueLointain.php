<?php

namespace App\Domain\MasqueLointain\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeMasqueLointain: int implements Enum
{
    case MASQUE_LOINTAIN_HOMOGENE = 1;
    case MASQUE_LOINTAIN_NON_HOMOGENE = 2;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::MASQUE_LOINTAIN_HOMOGENE => 'Masque lointain homogène',
            self::MASQUE_LOINTAIN_NON_HOMOGENE => 'Masque lointain non homogène',
        };
    }
}
