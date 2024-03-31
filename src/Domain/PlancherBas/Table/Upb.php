<?php

namespace App\Domain\PlancherBas\Table;

use App\Domain\Common\Table\TableValue;

class Upb implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly float $upb,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function upb(): float
    {
        return $this->upb;
    }
}
