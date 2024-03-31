<?php

namespace App\Domain\Climatisation\Table;

use App\Domain\Climatisation\Enum\PeriodeInstallation;
use App\Domain\Batiment\Enum\ZoneClimatique;

interface SeerRepository
{
    public function find(ZoneClimatique $zone_climatique, PeriodeInstallation $periode_installation): ?Seer;
}
