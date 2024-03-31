<?php

namespace App\Domain\PlancherBas\Table;

use App\Domain\Batiment\Enum\PeriodeConstruction;
use App\Domain\Paroi\Enum\Mitoyennete;

interface UeRepository
{
    public function search(Mitoyennete $mitoyennete, PeriodeConstruction $periode_construction,): UeCollection;
}
