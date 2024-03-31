<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Audit\Baie\DoubleFenetre;
use App\Domain\Common\Enum\Baie\TypeBaie;
use App\Domain\Common\Enum\Menuiserie\{MateriauxMenuiserie, TypePose};
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeGazLame, TypeVitrage};

final class SseDoubleFenetreCommand
{
    public function __construct(
        public readonly ?float $sw_saisi,
        public readonly bool $vitrage_vir,
        public readonly TypeBaie $type_baie,
        public readonly TypePose $type_pose,
        public readonly MateriauxMenuiserie $type_materiaux_menuiserie,
        public readonly TypeVitrage $type_vitrage,
        public readonly TypeGazLame $type_gaz_lame,
        public readonly InclinaisonVitrage $inclinaison_vitrage,
    ) {
    }

    public static function from(DoubleFenetre $entity,): self
    {
        return new self(
            sw_saisi: $entity->sw_saisi(),
            vitrage_vir: $entity->vitrage_vir(),
            type_baie: $entity->type_baie(),
            type_pose: $entity->type_pose(),
            type_materiaux_menuiserie: $entity->type_materiaux_menuiserie(),
            type_vitrage: $entity->type_vitrage(),
            type_gaz_lame: $entity->type_gaz_lame(),
            inclinaison_vitrage: $entity->inclinaison_vitrage(),
        );
    }
}
