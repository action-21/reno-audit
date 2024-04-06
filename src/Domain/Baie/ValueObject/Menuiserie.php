<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\{MateriauxMenuiserie, MethodeSaisiePerformance};

final class Menuiserie
{
    public function __construct(
        public readonly ?float $uw_saisi,
        public readonly MateriauxMenuiserie $type_materiaux,
        public readonly MethodeSaisiePerformance $methode_saisie_uw,
    ) {
    }

    /**
     * Performances de la menuiserie non requises
     */
    public static function create(MateriauxMenuiserie $type_materiaux): self
    {
        return new self(
            uw_saisi: null,
            type_materiaux: $type_materiaux,
            methode_saisie_uw: MethodeSaisiePerformance::NON_REQUIS,
        );
    }

    /**
     * Performances de la menuiserie déterminées sur la base des valeurs forfaitaires
     */
    public static function create_from_valeur_forfaitaire(MateriauxMenuiserie $type_materiaux): self
    {
        return new self(
            uw_saisi: null,
            type_materiaux: $type_materiaux,
            methode_saisie_uw: MethodeSaisiePerformance::VALEUR_FORFAITAIRE,
        );
    }

    /**
     * Performances de la menuiserie saisies directement à partir des documents justificatifs autorisés
     */
    public static function create_from_documents_justificatifs(float $uw_saisi, MateriauxMenuiserie $type_materiaux): self
    {
        return new self(
            uw_saisi: $uw_saisi,
            type_materiaux: $type_materiaux,
            methode_saisie_uw: MethodeSaisiePerformance::DOCUMENTS_JUSTIFICATIFS,
        );
    }
}
