<?php

namespace App\Domain\Paroi\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisie: int implements Enum
{
    case VALEUR_FORFAITAIRE = 1;
    case MESURE_OBSERVATION = 2;
    case DOCUMENTS_JUSTIFICATIFS = 3;
    case ETUDE_REGLEMENTAIRE = 4;

    /** @inheritdoc */
    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::VALEUR_FORFAITAIRE => 'Valeur forfaitaire',
            self::MESURE_OBSERVATION => 'Mesure et observation',
            self::DOCUMENTS_JUSTIFICATIFS => 'Saisie directe justifiée à partir des documents justificatifs autorisés',
            self::ETUDE_REGLEMENTAIRE => 'Saisie direct à partir d\'une étude réglementaire RT2012/RE2020',
        };
    }
}
