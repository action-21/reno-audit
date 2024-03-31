<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Common\Table\TableValue;

class CoefficientTransparence implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly float $t,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function t(): float
    {
        return $this->t;
    }
}
