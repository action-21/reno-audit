<?php

namespace App\Domain\Moteur3CL\Deperdition\Ventilation\Table;

use App\Domain\Moteur3CL\Common\TableValue;

class Q4paConv implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly float $q4pa_conv,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function q4pa_conv(): float
    {
        return $this->q4pa_conv;
    }
}
