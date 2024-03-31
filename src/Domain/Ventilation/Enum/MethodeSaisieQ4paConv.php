<?php

namespace App\Domain\Ventilation\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisieQ4paConv: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Valeur forfaitaire',
            self::ID_02 => 'Valeur justifiée saisie à partir des documents justificatifs autorisés',
            self::ID_03 => 'Saisie direct U depuis RSET/RSEE( etude RT2012/RE2020)'
        };
    }
}
