<?php

namespace App\Domain\PlancherBas\Table;

use App\Domain\PlancherBas\Enum\TypePlancherBas;

interface Upb0Repository
{
    public function find(TypePlancherBas $type_plancher_bas): ?Upb0;
}
