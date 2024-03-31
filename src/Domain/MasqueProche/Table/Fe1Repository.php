<?php

namespace App\Domain\MasqueProche\Table;

use App\Domain\MasqueProche\Enum\{Orientation, TypeMasqueProche};

interface Fe1Repository
{
    public function find(TypeMasqueProche $type_masque_proche, ?Orientation $orientation, ?float $avancee): ?Fe1;
}
