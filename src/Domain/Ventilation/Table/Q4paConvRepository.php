<?php

namespace App\Domain\Moteur3CL\Deperdition\Ventilation\Table;

use App\Domain\Batiment\Enum\PeriodeConstruction;
use App\Domain\Batiment\Enum\TypeBatiment;

interface Q4paConvRepository
{
    public function find(
        PeriodeConstruction $periode_construction,
        TypeBatiment $type_batiment,
        ?bool $presence_joints_menuiserie,
        ?bool $isolation_murs_plafonds
    ): ?Q4paConv;
}
