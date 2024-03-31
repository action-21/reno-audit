<?php

namespace App\Domain\Photovoltaique\Table;

use App\Domain\Common\Table\TableValue;

class CoefficientOrientation implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $coefficient_orientation)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function coefficient_orientation(): float
    {
        return $this->coefficient_orientation;
    }
}
