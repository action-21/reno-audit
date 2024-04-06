<?php

namespace App\Domain\PontThermique\Enum;

use App\Domain\Common\Enum\Enum;

/**
 * Méthode de saisie d'un pont thermique
 */
enum MethodeSaisiePontThermique: int implements Enum
{
    case VALEUR_FORFAITAIRE = 1;
    case DOCUMENTS_JUSTIFICATIFS = 2;
    case ETUDE_REGLEMENTAIRE = 3;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match($this)
        {
            self::VALEUR_FORFAITAIRE => 'Valeur forfaitaire',
            self::DOCUMENTS_JUSTIFICATIFS => 'Valeur justifiée saisie à partir des documents justificatifs autorisés',
            self::ETUDE_REGLEMENTAIRE => 'Saisie direct U depuis RSET/RSEE (étude RT2012/RE2020)'
        };
    }
}
