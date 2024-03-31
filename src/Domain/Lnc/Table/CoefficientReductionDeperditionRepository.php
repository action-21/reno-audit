<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Lnc\Enum\{TypeLnc};

interface CoefficientReductionDeperditionRepository
{
    public function find(
        TypeLnc $type_lnc,
        ?bool $isolation_aiu,
        ?bool $isolation_aue,
        ?float $surface_aiu,
        ?float $surface_aue,
    ): ?CoefficientReductionDeperdition;
}
