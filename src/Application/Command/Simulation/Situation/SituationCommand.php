<?php

namespace App\Command\Simulation\Situation;

use App\Domain\Audit\Audit;
use App\Domain\Common\Enum\Situation\{ClasseAltitude, ZoneClimatique};

final class SituationCommand
{
    public function __construct(
        public readonly bool $parois_anciennes_lourdes,
        public readonly ClasseAltitude $classe_altitude,
        public readonly ZoneClimatique $zone_climatique,
    ) {
    }

    public static function from(Audit $entity): self
    {
        return new self(
            parois_anciennes_lourdes: $entity->parois_anciennes_lourdes(),
            classe_altitude: $entity->classe_altitude(),
            zone_climatique: $entity->zone_climatique(),
        );
    }
}
