<?php

namespace App\Domain\PlancherHaut\Table;

use App\Domain\Batiment\Enum\{PeriodeConstruction, ZoneClimatique};
use App\Domain\Paroi\Enum\PeriodeIsolation;
use App\Domain\PlancherHaut\Enum\ConfigurationPlancherHaut;

interface UphRepository
{
    public function find(
        ZoneClimatique $zone_climatique,
        PeriodeConstruction|PeriodeIsolation $periode_construction_isolation,
        ConfigurationPlancherHaut $configuration_plancher_haut,
        bool $effet_joule,
    ): ?Uph;
}
