<?php

namespace App\Domain\PlancherHaut\Table;

use App\Domain\Common\Table\TableValue;

class Uph0 implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $uph0)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function uph0(): float
    {
        return $this->uph0;
    }
}
