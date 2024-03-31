<?php

namespace App\Domain\Baie\Table;

use App\Domain\Baie\Enum\TypeFermeture;

interface DeltarRepository
{
    public function find(TypeFermeture $type_fermeture): ?Deltar;
}
