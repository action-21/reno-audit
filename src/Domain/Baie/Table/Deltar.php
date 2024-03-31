<?php

namespace App\Domain\Baie\Table;

use App\Domain\Common\Table\TableValue;

class Deltar implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly float $deltar,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function deltar(): float
    {
        return $this->deltar;
    }
}
