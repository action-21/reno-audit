<?php

namespace App\Domain\PontThermique\ValueObject;

use App\Domain\PontThermique\Enum\MethodeSaisiePontThermique;

/**
 * Performance d'un pont thermique
 */
final class Performance
{
    public function __construct(
        public readonly ?float $k_saisi,
        public readonly MethodeSaisiePontThermique $methode_saisie,
    ) {
    }

    /**
     * Performance d'un pont thermique depuis des valeurs forfaitaires
     */
    public static function create_from_valeur_forfaitaire(): self
    {
        return new self(
            k_saisi: null,
            methode_saisie: MethodeSaisiePontThermique::VALEUR_FORFAITAIRE,
        );
    }

    /**
     * Performance d'un pont thermique depuis des documents justificatifs
     */
    public static function create_from_documents_justificatifs(float $k_saisi): self
    {
        return new self(
            k_saisi: $k_saisi,
            methode_saisie: MethodeSaisiePontThermique::DOCUMENTS_JUSTIFICATIFS,
        );
    }

    /**
     * Performance d'un pont thermique depuis une étude réglementaire
     */
    public static function create_from_etude_reglementaire(float $k_saisi): self
    {
        return new self(
            k_saisi: $k_saisi,
            methode_saisie: MethodeSaisiePontThermique::ETUDE_REGLEMENTAIRE,
        );
    }
}
