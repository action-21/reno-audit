<?php

namespace App\Domain\Moteur3CL\Ventilation\Table;

use App\Domain\Ventilation\Enum\TypeVentilation;

interface DebitRepository
{
    public function find(TypeVentilation $type_ventilation): ?Debit;
}
