<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Baie\Enum\InclinaisonVitrage;
use App\Domain\Paroi\Enum\Orientation;
use App\Domain\Batiment\Enum\ZoneClimatique;

interface C1Repository
{
    public function search(
        ZoneClimatique $zone_climatique,
        Orientation $orientation,
        InclinaisonVitrage $inclinaison_vitrage,
    ): C1Collection;
}
