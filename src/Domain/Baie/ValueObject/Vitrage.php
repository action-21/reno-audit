<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\{InclinaisonVitrage, MethodeSaisieUg, TypeGazLame, TypeVitrage};

final class Vitrage
{
    public function __construct(
        public readonly ?float $epaisseur_lame,
        public readonly ?float $ug_saisi,
        public readonly ?bool $vitrage_vir,
        public readonly MethodeSaisieUg $methode_saisie_ug,
        public readonly TypeVitrage $type_vitrage,
        public readonly InclinaisonVitrage $inclinaison_vitrage,
        public readonly ?TypeGazLame $type_gaz_lame,
    ) {
    }
}
