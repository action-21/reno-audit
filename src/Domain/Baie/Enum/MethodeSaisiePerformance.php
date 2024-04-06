<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisiePerformance: int implements Enum
{
    case VALEUR_FORFAITAIRE = 1;
    case DOCUMENTS_JUSTIFICATIFS = 2;
    case ETUDE_REGLEMENTAIRE = 3;
    case NON_REQUIS = 4;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::VALEUR_FORFAITAIRE => 'Déterminée à partir de la table de valeur forfaitaire',
            self::DOCUMENTS_JUSTIFICATIFS => 'Saisie directement à partir des documents justificatifs autorisés',
            self::ETUDE_REGLEMENTAIRE => 'Déterminée depuis RSET/RSEE (étude RT2012/RE2020)',
            self::NON_REQUIS => 'Non requise',
        };
    }
}
