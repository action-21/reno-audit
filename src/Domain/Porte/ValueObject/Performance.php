<?php

namespace App\Domain\Porte\ValueObject;

use App\Domain\Porte\Enum\MethodeSaisieUPorte;

/**
 * Performances d'une porte
 */
final class Performance
{
    public function __construct(
        public readonly ?float $uporte_saisi,
        public readonly MethodeSaisieUPorte $methode_saisie_uporte,
    ) {
    }

    /**
     * Performances d'une porte depuis une valeur forfaitaire
     */
    public static function create_from_valeur_forfaitaire(): self
    {
        return new self(
            uporte_saisi: null,
            methode_saisie_uporte: MethodeSaisieUPorte::VALEUR_FORFAITAIRE,
        );
    }

    /**
     * Performances d'une porte depuis une valeur justifiée
     */
    public static function create_from_documents_justificatifs(float $uporte_saisi): self
    {
        return new self(
            uporte_saisi: $uporte_saisi,
            methode_saisie_uporte: MethodeSaisieUPorte::VALEUR_JUSTIFIEE,
        );
    }

    /**
     * Performances d'une porte depuis une étude réglementaire
     */
    public static function create_from_etude_reglementaire(float $uporte_saisi): self
    {
        return new self(
            uporte_saisi: $uporte_saisi,
            methode_saisie_uporte: MethodeSaisieUPorte::VALEUR_ETUDE_REGLEMENTAIRE,
        );
    }
}
