<?php

namespace App\Domain\Batiment\Table;

use App\Domain\Batiment\Enum\{ClasseAltitude, ZoneClimatique};

interface SollicitationExterieureRepository
{
    public function search(
        ZoneClimatique $zone_climatique,
        ClasseAltitude $classe_altitude,
        bool $parois_anciennes_lourdes,
    ): SollicitationExterieureCollection;
}
