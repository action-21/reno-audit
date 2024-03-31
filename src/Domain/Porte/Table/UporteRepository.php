<?php

namespace App\Domain\Porte\Table;

use App\Domain\Porte\Enum\TypePorte;

interface UporteRepository
{
    public function find(TypePorte $type_porte): ?Uporte;
}
