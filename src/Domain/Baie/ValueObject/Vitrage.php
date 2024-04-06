<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\{InclinaisonVitrage, MethodeSaisiePerformance, TypeGazLame, TypeVitrage};

final class Vitrage
{
    public function __construct(
        public readonly ?float $epaisseur_lame,
        public readonly ?float $ug_saisi,
        public readonly ?bool $vitrage_vir,
        public readonly MethodeSaisiePerformance $methode_saisie_ug,
        public readonly ?TypeVitrage $type_vitrage,
        public readonly InclinaisonVitrage $inclinaison_vitrage,
        public readonly ?TypeGazLame $type_gaz_lame,
    ) {
    }

    /**
     * Performances du vitrages non requises
     */
    public static function create(
        TypeVitrage $type_vitrage,
        InclinaisonVitrage $inclinaison_vitrage,
        ?float $epaisseur_lame = null,
        ?bool $vitrage_vir = null,
        ?TypeGazLame $type_gaz_lame = null,
    ): self {
        return new self(
            ug_saisi: null,
            epaisseur_lame: $epaisseur_lame,
            vitrage_vir: $vitrage_vir,
            methode_saisie_ug: MethodeSaisiePerformance::NON_REQUIS,
            type_vitrage: $type_vitrage,
            inclinaison_vitrage: $inclinaison_vitrage,
            type_gaz_lame: $type_gaz_lame
        );
    }

    /**
     * Performances du vitrage déterminées sur la base des valeurs forfaitaires
     */
    public static function create_from_valeur_forfaitaire(
        float $epaisseur_lame,
        bool $vitrage_vir,
        TypeVitrage $type_vitrage,
        InclinaisonVitrage $inclinaison_vitrage,
        ?TypeGazLame $type_gaz_lame = null,
    ): self {
        return new self(
            epaisseur_lame: $epaisseur_lame,
            ug_saisi: null,
            vitrage_vir: $vitrage_vir,
            methode_saisie_ug: MethodeSaisiePerformance::VALEUR_FORFAITAIRE,
            type_vitrage: $type_vitrage,
            inclinaison_vitrage: $inclinaison_vitrage,
            type_gaz_lame: $type_gaz_lame
        );
    }

    /**
     * Performances du vitrage saisies directement à partir des documents justificatifs autorisés
     */
    public static function create_from_documents_justificatifs(
        float $ug_saisi,
        TypeVitrage $type_vitrage,
        InclinaisonVitrage $inclinaison_vitrage,
        bool $vitrage_vir,
        ?float $epaisseur_lame = null,
        ?TypeGazLame $type_gaz_lame = null,
    ): self {
        return new self(
            ug_saisi: $ug_saisi,
            epaisseur_lame: $epaisseur_lame,
            vitrage_vir: $vitrage_vir,
            methode_saisie_ug: MethodeSaisiePerformance::DOCUMENTS_JUSTIFICATIFS,
            type_vitrage: $type_vitrage,
            inclinaison_vitrage: $inclinaison_vitrage,
            type_gaz_lame: $type_gaz_lame
        );
    }
}
