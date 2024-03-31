<?php

namespace App\Domain\Batiment\Table;

use App\Domain\Batiment\Enum\ZoneClimatique;

interface NheclRepository
{
    public function search(ZoneClimatique $zone_climatique): NheclCollection;
}
