<?php

namespace App\Command\Simulation\Deperdition\Baie;

use App\Domain\Audit\Baie\DoubleFenetre;
use App\Domain\Common\Enum\Baie\TypeBaie;
use App\Domain\Common\Enum\Menuiserie\MateriauxMenuiserie;
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeGazLame, TypeVitrage};

final class DeperditionDoubleFenetreCommand
{
    public function __construct(
        public readonly ?float $ug_saisi,
        public readonly ?float $uw_saisi,
        public readonly ?float $epaisseur_lame,
        public readonly bool $vitrage_vir,
        public readonly TypeBaie $type_baie,
        public readonly MateriauxMenuiserie $type_materiaux_menuiserie,
        public readonly TypeVitrage $type_vitrage,
        public readonly TypeGazLame $type_gaz_lame,
        public readonly InclinaisonVitrage $inclinaison_vitrage,
    ) {
    }

    public static function from(DoubleFenetre $entity,): self
    {
        return new self(
            ug_saisi: $entity->ug_saisi(),
            uw_saisi: $entity->uw_saisi(),
            epaisseur_lame: $entity->epaisseur_lame(),
            vitrage_vir: $entity->vitrage_vir(),
            type_baie: $entity->type_baie(),
            type_materiaux_menuiserie: $entity->type_materiaux_menuiserie(),
            type_vitrage: $entity->type_vitrage(),
            type_gaz_lame: $entity->type_gaz_lame(),
            inclinaison_vitrage: $entity->inclinaison_vitrage(),
        );
    }
}
