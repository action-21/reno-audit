<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\{MethodeSaisiePerformance, TypeFermeture};

final class Fermeture
{
    public function __construct(
        public readonly ?float $ujn_saisi,
        public readonly TypeFermeture $type_fermeture,
        public readonly MethodeSaisiePerformance $methode_saisie_ujn,
    ) {
    }

    /**
     * Performance depuis une valeur forfaitaire
     */
    public static function create_from_valeur_forfaitaire(TypeFermeture $type_fermeture): self
    {
        return new self(
            ujn_saisi: null,
            type_fermeture: $type_fermeture,
            methode_saisie_ujn: MethodeSaisiePerformance::VALEUR_FORFAITAIRE,
        );
    }

    /**
     * Performance depuis des documents justificatifs autorisés
     */
    public static function create_from_documents_justificatifs(TypeFermeture $type_fermeture, float $ujn_saisi): self
    {
        return new self(
            ujn_saisi: $ujn_saisi,
            type_fermeture: $type_fermeture,
            methode_saisie_ujn: MethodeSaisiePerformance::DOCUMENTS_JUSTIFICATIFS,
        );
    }

    /**
     * Performance depuis une étude réglementaire
     */
    public static function create_from_etude_reglementaire(TypeFermeture $type_fermeture, float $ujn_saisi): self
    {
        return new self(
            ujn_saisi: $ujn_saisi,
            type_fermeture: $type_fermeture,
            methode_saisie_ujn: MethodeSaisiePerformance::ETUDE_REGLEMENTAIRE,
        );
    }
}
