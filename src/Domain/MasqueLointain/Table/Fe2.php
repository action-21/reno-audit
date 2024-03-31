<?php

namespace App\Domain\MasqueLointain\Table;

use App\Domain\Common\Table\TableValue;

final class Fe2 implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $fe2)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function fe2(): float
    {
        return $this->fe2;
    }
}
