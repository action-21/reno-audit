<?php

namespace App\Domain\PlancherBas\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisieU: int implements Enum
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

    /** @inheritdoc */
    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Non isolé',
            self::ID_02 => 'Isolation inconnue  (table forfaitaire)',
            self::ID_03 => 'Epaisseur isolation saisie justifiée par mesure ou observation',
            self::ID_04 => 'Epaisseur isolation saisie justifiée à partir des documents justificatifs autorisés',
            self::ID_05 => 'Resistance isolation saisie justifiée observation de l\'isolant installé et mesure de son épaisseur',
            self::ID_06 => 'Resistance isolation saisie justifiée à partir des documents justificatifs autorisés',
            self::ID_07 => 'Année d\'isolation différente de l\'année de construction saisie justifiée (table forfaitaire)',
            self::ID_08 => 'Année de construction saisie (table forfaitaire)',
            self::ID_09 => 'Saisie direct U justifiée  (à partir des documents justificatifs autorisés)',
            self::ID_10 => 'Saisie direct U depuis RSET/RSEE( etude RT2012/RE2020)',
        };
    }
}
