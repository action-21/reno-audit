<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Common\Table\TableValue;

class CoefficientReductionDeperdition implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $b)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function b(): float
    {
        return $this->b;
    }
}
