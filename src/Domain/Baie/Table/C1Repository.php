<?php

namespace App\Domain\Baie\Table;

use App\Domain\Baie\Enum\InclinaisonVitrage;
use App\Domain\Batiment\Enum\ZoneClimatique;
use App\Domain\Paroi\Enum\Orientation;

interface C1Repository
{
    public function search(
        ZoneClimatique $zone_climatique,
        Orientation $orientation,
        InclinaisonVitrage $inclinaison_vitrage,
    ): C1Collection;
}
