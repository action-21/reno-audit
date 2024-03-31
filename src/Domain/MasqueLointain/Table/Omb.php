<?php

namespace App\Domain\MasqueLointain\Table;

use App\Domain\Common\Table\TableValue;

final class Omb implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $omb)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function omb(): float
    {
        return $this->omb;
    }
}
