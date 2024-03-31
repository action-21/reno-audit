<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Audit\Lnc\EtsBaie;
use App\Domain\Common\Enum\Menuiserie\MateriauxMenuiserie;
use App\Domain\Common\Enum\Paroi\Orientation;
use App\Domain\Common\Enum\Situation\ZoneClimatique;
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeVitrage};

final class SseEtsBaieCommand
{
    public function __construct(
        public readonly float $surface,
        public readonly bool $vitrage_vir,
        public readonly ZoneClimatique $zone_climatique,
        public readonly Orientation $orientation,
        public readonly MateriauxMenuiserie $type_materiaux_menuiserie,
        public readonly TypeVitrage $type_vitrage,
        public readonly InclinaisonVitrage $inclinaison_vitrage,
    ) {
    }

    public static function from(EtsBaie $entity): self
    {
        return new self(
            surface: $entity->surface(),
            vitrage_vir: $entity->vitrage_vir(),
            zone_climatique: $entity->ets()->enveloppe()->audit()->zone_climatique(),
            orientation: $entity->orientation(),
            type_materiaux_menuiserie: $entity->type_materiaux_menuiserie(),
            type_vitrage: $entity->type_vitrage(),
            inclinaison_vitrage: $entity->inclinaison_vitrage(),
        );
    }
}
