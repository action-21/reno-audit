<?php

namespace App\Domain\Paroi\ValueObject;

use App\Domain\Paroi\Enum\MethodeSaisiePerformance;

final class Performance
{
    public function __construct(
        public readonly MethodeSaisiePerformance $methode_saisie,
        public readonly ?float $u0_saisi = null,
    ) {
    }

    public static function from_valeur_forfaitaire(): self
    {
        return new self(methode_saisie: MethodeSaisiePerformance::VALEUR_FORFAITAIRE);
    }

    public static function from_observation(): self
    {
        return new self(methode_saisie: MethodeSaisiePerformance::MESURE_OBSERVATION);
    }

    public static function from_documents_justificatifs(float $u0_saisi): self
    {
        return new self(
            methode_saisie: MethodeSaisiePerformance::DOCUMENTS_JUSTIFICATIFS,
            u0_saisi: $u0_saisi,
        );
    }

    public static function from_etude_reglementaire(float $u0_saisi): self
    {
        return new self(
            methode_saisie: MethodeSaisiePerformance::ETUDE_REGLEMENTAIRE,
            u0_saisi: $u0_saisi,
        );
    }
}
