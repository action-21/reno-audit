<?php

namespace App\Domain\Batiment\Table;

use App\Domain\Batiment\Enum\{ClasseAltitude, ZoneClimatique};

interface TbaseRepository
{
    public function find(ZoneClimatique $zone_climatique, ClasseAltitude $classe_altitude): ?Tbase;
}
