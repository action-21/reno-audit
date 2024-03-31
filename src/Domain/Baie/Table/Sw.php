<?php

namespace App\Domain\Baie\Table;

use App\Domain\Common\Table\TableValue;

class Sw implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly float $sw,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function sw(): float
    {
        return $this->sw;
    }
}
