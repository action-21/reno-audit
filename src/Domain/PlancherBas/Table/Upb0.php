<?php

namespace App\Domain\PlancherBas\Table;

use App\Domain\Common\Table\TableValue;

class Upb0 implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly float $upb0,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function upb0(): float
    {
        return $this->upb0;
    }
}
