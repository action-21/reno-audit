<?php

namespace App\Domain\PontThermique\Table;

use App\Domain\Common\Table\TableValue;

class Kpt implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $k)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function k(): float
    {
        return $this->k;
    }
}
