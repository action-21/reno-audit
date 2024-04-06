<?php

namespace App\Domain\Porte\Enum;

use App\Domain\Common\Enum\Enum;

/**
 * Méthode de saisie des performances d'une porte
 */
enum MethodeSaisieUPorte: int implements Enum
{
    case VALEUR_FORFAITAIRE = 1;
    case VALEUR_JUSTIFIEE = 2;
    case VALEUR_ETUDE_REGLEMENTAIRE = 3;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::VALEUR_FORFAITAIRE => 'Valeur forfaitaire',
            self::VALEUR_JUSTIFIEE => 'Valeur justifiée saisie à partir des documents justificatifs autorisés',
            self::VALEUR_ETUDE_REGLEMENTAIRE => 'Saisie direct U depuis RSET/RSEE (étude RT2012/RE2020)'
        };
    }
}
