<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\MethodeSaisiePerformance;

final class Performance
{
    public function __construct(
        public readonly ?float $sw_saisi,
        public readonly MethodeSaisiePerformance $methode_saisie_sw,
    ) {
    }

    /**
     * Performances de la menuiserie déterminées sur la base des valeurs forfaitaires
     */
    public static function create_from_valeur_forfaitaire(): self
    {
        return new self(
            sw_saisi: null,
            methode_saisie_sw: MethodeSaisiePerformance::VALEUR_FORFAITAIRE,
        );
    }

    /**
     * Performances de la menuiserie saisies directement à partir des documents justificatifs autorisés
     */
    public static function create_from_documents_justificatifs(float $sw_saisi): self
    {
        return new self(
            sw_saisi: $sw_saisi,
            methode_saisie_sw: MethodeSaisiePerformance::DOCUMENTS_JUSTIFICATIFS,
        );
    }

    /**
     * Performance depuis une étude réglementaire
     */
    public static function create_from_etude_reglementaire(float $sw_saisi): self
    {
        return new self(
            sw_saisi: $sw_saisi,
            methode_saisie_sw: MethodeSaisiePerformance::ETUDE_REGLEMENTAIRE,
        );
    }
}
