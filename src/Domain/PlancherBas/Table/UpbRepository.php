<?php

namespace App\Domain\PlancherBas\Table;

use App\Domain\Paroi\Enum\PeriodeIsolation;
use App\Domain\Batiment\Enum\{PeriodeConstruction, ZoneClimatique};

interface UpbRepository
{
    public function find(
        ZoneClimatique $zone_climatique,
        PeriodeConstruction|PeriodeIsolation $periode_construction_isolation,
        bool $effet_joule,
    ): ?Upb;
}
