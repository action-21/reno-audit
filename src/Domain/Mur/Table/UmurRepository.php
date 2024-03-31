<?php

namespace App\Domain\Mur\Table;

use App\Domain\Batiment\Enum\{PeriodeConstruction, ZoneClimatique};
use App\Domain\Paroi\Enum\PeriodeIsolation;

interface UmurRepository
{
    public function find(
        ZoneClimatique $zone_climatique,
        PeriodeConstruction|PeriodeIsolation $periode_construction_isolation,
        bool $effet_joule,
    ): ?Umur;
}
