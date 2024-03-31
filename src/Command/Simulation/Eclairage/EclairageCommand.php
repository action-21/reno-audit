<?php

namespace App\Command\Simulation\Eclairage;

use App\Domain\Common\Enum\Situation\ZoneClimatique;

final class EclairageCommand
{
    public function __construct(
        public readonly float $surface_habitable_moyenne,
        public readonly ZoneClimatique $zone_climatique,
    ) {
    }
}
