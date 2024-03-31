<?php

namespace App\Domain\Photovoltaique\Table;

use App\Domain\Photovolotaique\Enum\{Inclinaison, Orientation};

interface CoefficientOrientationRepository
{
    public function find(Inclinaison $inclinaison, Orientation $orientation): ?CoefficientOrientation;
}
