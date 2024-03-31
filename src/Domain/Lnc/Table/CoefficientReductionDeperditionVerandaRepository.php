<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Batiment\Enum\ZoneClimatique;

interface CoefficientReductionDeperditionVerandaRepository
{
    public function search(bool $isolation_aiu, ZoneClimatique $zone_climatique): CoefficientReductionDeperditionVerandaCollection;
}
