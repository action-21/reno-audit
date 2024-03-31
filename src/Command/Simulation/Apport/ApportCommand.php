<?php

namespace App\Command\Simulation\Apport;

use App\Command\Simulation\Apport\SurfaceSudEquivalente\SseBaieCommand;
use App\Domain\Common\Enum\Inertie\ClasseInertie;
use App\Domain\Common\Enum\Situation\{ClasseAltitude, ZoneClimatique};
use App\Domain\Audit\Baie\Baie;
use App\Domain\Audit\Logement\Logement;

/**
 * @property SseBaieCommand[] $baie_collection
 */
final class ApportCommand
{
    public function __construct(
        public readonly float $surface_habitable,
        public readonly bool $parois_anciennes_lourdes,
        public readonly ClasseAltitude $classe_altitude,
        public readonly ZoneClimatique $zone_climatique,
        public readonly ClasseInertie $classe_inertie,
        public readonly float $gv,
        public readonly float $nadeq,
        public readonly array $baie_collection,
    ) {
    }

    public static function from(Logement $entity, float $gv, float $nadeq): self
    {
        return new self(
            surface_habitable: $entity->surface_habitable(),
            parois_anciennes_lourdes: $entity->audit()->parois_anciennes_lourdes(),
            classe_inertie: $entity->classe_inertie(),
            classe_altitude: $entity->audit()->classe_altitude(),
            zone_climatique: $entity->audit()->zone_climatique(),
            gv: $gv,
            nadeq: $nadeq,
            baie_collection: \array_map(
                fn (Baie $item): SseBaieCommand => SseBaieCommand::from($item),
                $entity->baie_collection()->values(),
            )
        );
    }
}
