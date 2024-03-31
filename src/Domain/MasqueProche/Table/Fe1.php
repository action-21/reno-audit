<?php

namespace App\Domain\MasqueProche\Table;

use App\Domain\Common\Table\TableValue;

class Fe1 implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly float $fe1,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function fe1(): float
    {
        return $this->fe1;
    }
}
